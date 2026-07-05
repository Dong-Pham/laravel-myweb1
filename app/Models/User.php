<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // chỉ định tên bảng trong database
    // (có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều )
    protected $table = 'users';

    // chỉ định tên cột khóa chính
    // có thể bỏ qua khai báo $primaryKey nếu primary key có tên 'id'
    protected $primaryKey = 'user_id';

    // các cột cho phép thêm/sửa dữ liệu hàng loạt
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'birthday',
        'role',
        'status'
    ];
}
