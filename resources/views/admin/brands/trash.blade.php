{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Thương Hiệu')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Thương Hiệu - Đang chờ xóa ({{ $trashCount }} bản ghi)</h2>
    {{-- gọi component --}}
    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Quay lại thương hiệu
        </a>
        @if ($trashCount > 0)
            <form action="{{ route('admin.brands.restoreAll') }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button onclick="return confirm('Khôi phục tất cả?')" class="btn btn-success">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Khôi phục tất cả
                </button>
            </form>
            <form action="{{ route('admin.brands.forceDeleteAll') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xóa vĩnh viễn tất cả?')" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Xóa vĩnh viễn tất cả
                </button>
            </form>
        @endif
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên thương hiệu</th>
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
                            <img src="{{ asset('storage/brands/' . $item->image) }}" width="80" class="img-thumbnail">
                        @endif
                    </td>
                    <td>{{ $item->brandname }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.brands.restore', $item->brand_id) }}" method="POST" class="d-inline">

                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.brands.forceDelete', $item->brand_id) }}" method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Xóa vĩnh viễn?')"class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form>
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
