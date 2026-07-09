<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $users = User::select('user_id', 'fullname')->get();
        return view('admin.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'role' => $request->role ?? '2',
                'status' => $request->status
            ]);
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Thêm người dùng thành công');
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
        return "Chi tiết người dùng có id: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // $user = User::find($id); --- IGNORE ---
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'role' => $request->role ?? '2',
                'status' => $request->status
            ]);

            // Cập nhật mật khẩu nếu có
            if (!empty($request->password)) {
                $user['password'] = Hash::make($request->password);
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Cập nhật người dùng thành công');
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
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
