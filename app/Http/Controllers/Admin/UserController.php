<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 10)
    {
        // Query Builder
        // $list = DB::table('users')
        //     ->select('user_id', 'username', 'email', 'phone', 'role', 'status')
        //     ->where('status', 1)
        //     ->orderBy('username')
        //     ->get();

        // ==== ORM Eloquent ====
        $list = User::select('user_id', 'username', 'email', 'phone', 'role', 'status')
            ->orderBy('username')
            ->paginate($limit);
        return view('admin.users.index', compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Tạo người dùng mới";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Lưu người dùng mới";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Chi tiết người dùng có id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Chỉnh sửa người dùng có id: " . $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Cập nhật người dùng có id: " . $id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
