@extends('admin.layouts.admin')
@section('title', 'Chỉnh Sửa Bài Viết')

@section('content')
    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Chỉnh sửa bài viết</h3>
        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.posts.update', $post->post_id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}"
                            required>
                        @error('title')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}"
                            required>
                        @error('slug')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status', $post->status) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>
                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status', $post->status) == 0 ? 'checked' : '' }}>
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
                        <label class="form-label">Người viết</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Chọn người viết --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ old('user_id', $post->user_id) == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" rows="10" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                Lưu bài viết
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
