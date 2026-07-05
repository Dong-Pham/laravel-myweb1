@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
    <h2 class="mb-4">THÊM THƯƠNG HIỆU MỚI</h2>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control" value="{{ old('brandname') }}">
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="mb-3">
            <label>Thứ tự sắp xếp</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Trạng thái</label>
            <input type="radio" class="btn-check" name="status" id="active" value="1"
                {{ old('status', 1) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="active">
                Hiển thị
            </label>
            <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                {{ old('status', 1) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="inactive">
                Ẩn
            </label>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả thương hiệu</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn_primary">
            Lưu sản phẩm
        </button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            Quay lại
        </a>
    </form>
@endsection
