{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Bài Viết')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Bài Viết</h2>

    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Slug</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Người viết</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/images/posts/' . ($item->image ?: 'default.png')) }}"
                            alt="{{ $item->title }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ Str::limit($item->content, 100) }}</td>
                    <td>{{ $item->fullname }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $item->post_id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
