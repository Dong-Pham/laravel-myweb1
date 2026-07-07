@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')
    <div class="border rounded bg-white p-4  shadow-sm">
        <h2 class="mb-4">THÊM THƯƠNG HIỆU MỚI</h2>

        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.brands.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Tên thương hiệu</label>
                <input type="text" name="brandname" class="form-control" value="{{ old('brandname') }}">
                @error('brandname')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                @error('slug')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Trạng thái</label>
                <input type="radio" class="btn-check" name="status" id="active" value="1"
                    {{ old('status', 1) == 1 }}>
                <label class="btn btn-outline-success" for="active">
                    Hiển thị
                </label>
                <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                    {{ old('status', 1) == 0 }}>
                <label class="btn btn-outline-danger" for="inactive">
                    Ẩn
                </label>
                @error('status')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả thương hiệu</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Lưu thương hiệu
            </button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
