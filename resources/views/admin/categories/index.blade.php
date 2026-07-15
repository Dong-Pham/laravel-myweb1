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
    <div class="d-flex justify-content-end mb-3 gap-2">
        <a href="{{ route('admin.categories.trash') }}" class="btn btn-danger">
            <i class="bi bi-trash-fill"></i> Thùng rác
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Thêm mới
        </a>
    </div>

    {{-- gọi component --}}
    <x-admin.alert />

    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th width="120">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $list->firstItem() + $loop->index }}</td>
                    <td>
                        @if ($item->image)
                            <img src="{{ asset('storage/categories/' . $item->image) }}" width="80"
                                class="img-thumbnail">
                        @endif
                    </td>
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

                            <a href="{{ route('admin.categories.edit', $item->cateid) }}"class="btn btn-warning btn-sm">
                                <i class = "bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Hiển thị phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
@endsection
