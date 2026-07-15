{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Người Dùng')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Người Dùng - Đang chờ xóa ({{ $trashCount }} bản ghi)</h2>
    {{-- gọi component --}}
    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Quay lại người dùng
        </a>
        @if ($trashCount > 0)
            <form action="{{ route('admin.users.restoreAll') }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button onclick="return confirm('Khôi phục tất cả?')" class="btn btn-success">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Khôi phục tất cả
                </button>
            </form>
            <form action="{{ route('admin.users.forceDeleteAll') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xóa vĩnh viễn tất cả?')" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Xóa vĩnh viễn tất cả
                </button>
            </form>
        @endif
    </div>

    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $list->firstItem() + $loop->index }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        @if ($item->role == 1)
                            <span class="badge bg-secondary">Quản lý</span>
                        @else
                            <span class="badge bg-info">Nhân viên</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-danger">Khóa</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.users.restore', $item->user_id) }}" method="POST" class="d-inline">

                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.users.forceDelete', $item->user_id) }}" method="POST"
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
