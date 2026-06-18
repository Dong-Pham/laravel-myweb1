{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Loại Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Loại Sản Phẩm</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
            + Thêm mới
        </a>
    </div>
    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Mã loại</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/images/categories/' . ($item->image ?: 'default.png')) }}"
                            alt="{{ $item->catename }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $item->cateid }}</td>
                    <td>{{ $item->catename }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content gap-2">

                            <a href="{{ route('admin.categories.edit', $item->cateid) }}"
                                class="btn btn-sm btn-outline-primary">
                                Sửa
                            </a>

                            <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Xóa
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
