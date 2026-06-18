{{-- thừa kế layout/view admin.blade.php --}}
{{-- resources/views/admin/layouts/admin.blade.php --}}
@extends ('admin.layouts.admin')

{{-- Gán nội dung cho vùng section 'title' --}}
{{-- (tương ứng với @yield('title') trong layout) --}}
@section('title', 'Người Dùng')

{{-- Gán nội dung cho vùng section 'content' --}}
{{-- (tương ứng với @yield('content') trong layout) --}}
@section('content')
    <h2 class="mb-3">Danh Sách Người Dùng</h2>

    <table class ="table table-bordered table-hover table-striped">
        <thead class='table-dark'>
            <tr>
                <th>STT</th>
                <th>User_ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        @if ($item->role == 1)
                            <span class="badge bg-secondary">Quản trị viên</span>
                        @else
                            <span class="badge bg-info">Người dùng</span>
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
                        <form action="{{ route('admin.users.destroy', $item->user_id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?')">
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
