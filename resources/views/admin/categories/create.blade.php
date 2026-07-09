{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Thêm Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <div class="border rounded bg-white p-4  shadow-sm">
        <h2 class="mb-3">Thêm Loại Sản Phẩm Mới</h2>

        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="catename" class="form-control" value="{{ old('catename') }}" required>
                {{-- hiển thị lỗi cho trường catname --}}
                @error('catename')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                {{-- hiển thị lỗi cho trường slug --}}
                @error('slug')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3 img-group">
                <label>Hình ảnh loại sản phẩm</label>
                <input type="file" name="img" class="form-control img-input">
                <div class="img-preview mt-2"></div>
                {{-- hiển thị lỗi cho trường img --}}
                @error('img')
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
                {{-- hiển thị lỗi cho trường status --}}
                @error('status')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả loại sản phẩm</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                Lưu loại sản phẩm
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
