<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:200',
                Rule::unique('posts', 'title')->ignore($post, 'post_id'),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post, 'post_id'),
                'regex:/^[A-Za-z0-9_-]+$/',
            ],
            'content' => 'nullable|string',
            'status' => 'required|in:0,1',
            'user_id' => 'required|exists:users,user_id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi ký tự.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'regex' => ':attribute chỉ được chứa chữ, số, _ và -.',
            'in' => ':attribute không hợp lệ.',
            'exists' => ':attribute không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'user_id' => 'Người đăng',
        ];
    }
}
