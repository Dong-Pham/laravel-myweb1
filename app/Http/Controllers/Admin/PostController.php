<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            // upload hình ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $baseName = $request->input('slug', $request->input('title'));
                $fileName = Str::slug($baseName)
                    . '-' . time()
                    . '.' . $file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/posts
                $file->storeAs('posts', $fileName, 'public');
            }
            // Thực hiện thêm dữ liệu
            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->input('content'),
                'status' => $request->status,
                'user_id' => $request->user_id,
                'image' => $fileName
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

            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $post->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ nếu tồn tại
                if ($fileName) {
                    Storage::disk('public')->delete('posts/' . $post->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->postname)
                    . '-' . time()
                    . '.' . $file->getClientOriginalExtension();
                $file->storeAs('posts', $fileName, 'public');
            }

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->input('content'),
                'status' => $request->status,
                'user_id' => $request->user_id,
                'image' => $fileName
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
        try {
            Post::findOrFail($id)->delete();

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Xóa thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    // khôi phục dữ liệu đã xóa
    public function restore($id)
    {
        try {
            Post::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục thất bại.');
        }
    }

    // xóa vĩnh viễn
    public function forceDelete($id)
    {
        try {
            Post::onlyTrashed()->findOrFail($id)->forceDelete();
            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa thất bại.');
        }
    }

    public function trash(Request $request)
    {
        $limit = $request->input('limit', 10);
        $list = Post::onlyTrashed()->orderBy('title')->paginate($limit);
        $trashCount = Post::onlyTrashed()->count();
        return view('admin.posts.trash', compact('list', 'trashCount'));
    }

    // khôi phục tất cả
    public function restoreAll()
    {
        try {
            Post::onlyTrashed()->restore();
            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Khôi phục tất cả thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục tất cả thất bại.');
        }
    }

    // xóa vĩnh viễn tất cả
    public function forceDeleteAll()
    {
        try {
            Post::onlyTrashed()->forceDelete();
            return redirect()
                ->route('admin.posts.trash')
                ->with('success', 'Xóa vĩnh viễn tất cả thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa vĩnh viễn tất cả thất bại.');
        }
    }
}
