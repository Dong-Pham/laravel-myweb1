@extends('admin.layouts.admin')

@section('title', 'Cập nhật người dùng')

@section('content')
    <h2 class="mb-4">CẬP NHẬT NGƯỜI DÙNG </h2>

    <div class="border rounded bg-white p-4  shadow-sm">
        <h3 class= "mb-4">Thêm sản phẩm</h3>

        {{-- gọi component --}}
        <x-admin.alert />

        <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="fullname" class="form-control" value="{{ old('fullname', $user->fullname) }}">
                @error('fullname')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
                @error('username')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Mật khẩu (để trống nếu không đổi)</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                @error('address')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Giới tính</label>
                <select name="gender" class="form-control">
                    <option value="">-- Chọn giới tính --</option>
                    <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>Nam</option>
                    <option value="2" {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>Nữ</option>
                    <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>Không cung cấp
                    </option>
                </select>
                @error('gender')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Ngày sinh</label>
                <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $user->birthday) }}">
                @error('birthday')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Vai trò</label>
                <select name="role" class="form-control">
                    <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Quản lý</option>
                    <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Nhân viên</option>
                </select>
                @error('role')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <div>
                    <input type="radio" class="btn-check" name="status" id="active" value="1"
                        {{ old('status', $user->status) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">
                        Kích hoạt
                    </label>
                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                        {{ old('status', $user->status) == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">
                        Khóa
                    </label>
                </div>
                @error('status')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Lưu người dùng
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
