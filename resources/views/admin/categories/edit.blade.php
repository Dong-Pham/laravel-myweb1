{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Sửa Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <div class="border rounded bg-white p-4  shadow-sm">
        <h2 class="mb-3">Sửa Loại Sản Phẩm</h2>

        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Tên loại sản phẩm</label>
                <input type="text" name="catename" class="form-control" value="{{ old('catename', $category->catename) }}">
                {{-- hiển thị lỗi cho trường catname --}}
                @error('catename')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
                {{-- hiển thị lỗi cho trường slug --}}
                @error('slug')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <div>
                    <input type="radio" class="btn-check" name="status" id="active" value="1"
                        {{ old('status', $category->status) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">
                        Hiển thị
                    </label>
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                        {{ old('status', $category->status) == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">
                        Ẩn
                    </label>
                    {{-- hiển thị lỗi cho trường catname --}}
                    @error('status')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                Lưu sản phẩm
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
