<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product = $this->route('product');

        return [
            'productname' => [
                'required',
                'string',
                'min:5',
                'max:150',
                Rule::unique('products', 'productname')->ignore($product),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('products', 'slug')->ignore($product),
                'regex:/^[A-Za-z0-9_-]+$/',
            ],
            'price' => 'required|numeric|gte:0|lt:10000000',
            'pricediscount' => 'nullable|numeric|gte:0|lte:price',
            'status' => 'required|in:0,1',
            'cateid' => 'required|exists:categories,cateid',
            'brand_id' => 'required|exists:brands,brand_id',
            'description' => ['nullable', 'string', 'regex:/^(?!.*[@!$^]).*$/s'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'numeric' => ':attribute phải là số hợp lệ.',
            'gte' => ':attribute phải lớn hơn hoặc bằng :value.',
            'lt' => ':attribute phải nhỏ hơn :value.',
            'lte' => ':attribute không được lớn hơn :value.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ, số, dấu gạch ngang (-) và dấu gạch dưới (_).',
            'status.in' => ':attribute không hợp lệ.',
            'cateid.exists' => 'Loại sản phẩm không tồn tại.',
            'brand_id.exists' => 'Thương hiệu không tồn tại.',
            'description.regex' => ':attribute không được chứa các ký tự @, !, $, ^.',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn (Slug)',
            'price' => 'Giá',
            'pricediscount' => 'Giá khuyến mãi',
            'status' => 'Trạng thái',
            'cateid' => 'Loại sản phẩm',
            'brand_id' => 'Thương hiệu',
            'description' => 'Mô tả',
        ];
    }
}
