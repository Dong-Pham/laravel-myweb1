<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Query Builder
        // $list = DB::table('posts')
        //     ->join('users', 'posts.user_id', '=', 'users.user_id')
        //     ->select(
        //         'posts.post_id',
        //         'posts.title',
        //         'posts.slug',
        //         'posts.image',
        //         'posts.content',
        //         'posts.status',
        //         'users.fullname'
        //     )
        //     ->orderBy('posts.title')
        //     ->get();
        // return view('admin.posts.index', ['list' => $list]);

        // ==== ORM Eloquent ====
        $list = Post::with([
            'user:user_id,fullname'
        ])
            ->select(
                'post_id',
                'title',
                'slug',
                'image',
                'content',
                'status',
                'user_id'
            )
            ->orderBy('title')
            ->paginate($limit);
        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('user_id', 'fullname')->get();
        return view('admin.posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->input('content'),
                'status' => $request->status,
                'user_id' => $request->user_id,
                'image' => null
            ]);
            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Thêm bài viết thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Chi tiết bài viết có id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::select('user_id', 'fullname')->get();
        return view('admin.posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->input('content'),
                'status' => $request->status,
                'user_id' => $request->user_id
            ]);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Cập nhật bài viết thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}
