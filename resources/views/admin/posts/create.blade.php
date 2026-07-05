@extends('admin.layouts.admin')
@section('title', 'Thêm Bài Viết')

@section('content')
    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Thêm bài viết mới</h3>
        {{-- Hiển thị lỗi từ session flash --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status', 1) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>
                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status', 0) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Ẩn
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Người viết</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Chọn người viết --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn_primary">
                Lưu sản phẩm
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
