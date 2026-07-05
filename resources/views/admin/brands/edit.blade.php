@extends('admin.layouts.admin')

@section('title', 'Cập nhật thương hiệu')

@section('content')
    <h2 class="mb-4">CẬP NHẬT THƯƠNG HIỆU </h2>

    <form action="{{ route('admin.brands.update', $brand->brand_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control" value="{{ old('brandname', $brand->brandname) }}">
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug) }}">
        </div>

        <div class="mb-3">
            <label>Thứ tự sắp xếp</label>
            <input type="number" name="sort_order" class="form-control"
                value="{{ old('sort_order', $brand->sort_order) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <div>
                <input type="radio" class="btn-check" name="status" id="active" value="1"
                    {{ old('status', $brand->status) == 1 ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="active">
                    Hiển thị
                </label>
                <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                    {{ old('status', $brand->status) == 0 ? 'checked' : '' }}>
                <label class="btn btn-outline-danger" for="inactive">
                    Ẩn
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả thương hiệu</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description', $brand->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn_primary">
            Lưu sản phẩm
        </button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            Quay lại
        </a>
    </form>
@endsection
