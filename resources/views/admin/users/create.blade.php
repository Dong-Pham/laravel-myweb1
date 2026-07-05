@extends('admin.layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
    <h2 class="mb-4">THÊM NGƯỜI DÙNG MỚI</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
        </div>

        <div class="mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-control">
                <option value="">-- Chọn giới tính --</option>
                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Nữ</option>
                <option value="0" {{ old('gender') == 0 ? 'selected' : '' }}>Không cung cấp</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role" class="form-control">
                <option value="1" {{ old('role', 1) == 1 ? 'selected' : '' }}>Quản lý</option>
                <option value="2" {{ old('role', 2) == 2 ? 'selected' : '' }}>Nhân viên</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Trạng thái</label>
            <input type="radio" class="btn-check" name="status" id="active" value="1"
                {{ old('status', 1) == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-success" for="active">
                Kích hoạt
            </label>
            <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                {{ old('status', 1) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-danger" for="inactive">
                Khóa
            </label>
        </div>

        <button type="submit" class="btn btn_primary">
            Lưu người dùng
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            Quay lại
        </a>
    </form>
@endsection
