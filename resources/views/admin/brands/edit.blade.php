@extends('admin.layouts.admin')

@section('title', 'Cập nhật thương hiệu')

@section('content')
    <div class="border rounded bg-white p-4  shadow-sm">
        <h2 class="mb-4">CẬP NHẬT THƯƠNG HIỆU </h2>

        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.brands.update', $brand->brand_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Tên thương hiệu</label>
                <input type="text" name="brandname" class="form-control" value="{{ old('brandname', $brand->brandname) }}">
                @error('brandname')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug) }}">
                @error('slug')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3 img-group">
                <label class="form-label">Logo thương hiệu</label>
                <input type="file" name="img" class="form-control img-input">
                <div class="img-preview mt-2">
                    @if ($brand->image)
                        <img src="{{ asset('storage/brands/' . $brand->image) }}" alt="{{ $brand->brandname }}"
                            width="150" class="img-thumbnail">
                    @endif
                </div>
                {{-- Hiển thị lỗi cho trường img --}}
                @error('img')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
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
                @error('status')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả thương hiệu</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $brand->description) }}</textarea>
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
