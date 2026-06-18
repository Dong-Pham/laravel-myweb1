<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.user_id')
            ->select(
                'posts.post_id',
                'posts.title',
                'posts.slug',
                'posts.image',
                'posts.content',
                'posts.status',
                'users.fullname'
            )
            ->orderBy('posts.title')
            ->get();
        return view('admin.posts.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Tạo bài viết mới";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Lưu bài viết mới";
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
        return "Chỉnh sửa bài viết có id: " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Cập nhật bài viết có id: " . $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}
