{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Sản Phẩm')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Sản Phẩm</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">
            + Thêm mới
        </a>
    </div>
    @if (@session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Thương Hiệu</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $item)
                <tr>
                    <td>{{ $list->firstItem() + $loop->index }}</td>
                    <td>
                        <img src="{{ asset('storage/images/products/' . ($item->image ?: 'default.png')) }}"
                            alt="{{ $item->productname }}" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $item->productname }}</td>
                    <td>{{ $item->category->catename }}</td>
                    <td>{{ $item->brand->brandname }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $item->id) }}"class="btn btn-warning btn-sm">
                            <i class = "bi bi-pencil-square"></i>
                        </a>
                        <a href="{{ route('admin.products.destroy', $item->id) }}"class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                            <i class = "bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Không có dữ liệu
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Hiển thị phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
@endsection
