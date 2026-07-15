<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    // Có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều
    protected $table = 'posts';
    // Có thể bỏ qua khai báo $primaryKey nếu primary key có tên 'id'
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'postname',
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'status',
        'description'
    ];
    // Cấu hình Quan hệ với User

    public function user()
    {
        // posts.user_id = users.user_id
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
