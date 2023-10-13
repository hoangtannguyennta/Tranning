@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<a href="{{ request()->getSchemeAndHttpHost(). '/users' }}">nguyen</a>
<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo danh sách người dùng') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên') }}</label>
                        <input class="input" type="text" id="fname" name="name" value="{{ Request::old('name') }}" placeholder="Nhập tên" required>
                        <label for="lname">{{ __('Email') }}</label>
                        <input class="input" type="email" id="lname" name="email" value="{{ Request::old('email') }}" placeholder="Nhập email" required>
                        <label for="fname">{{ __('Mật khẩu') }}</label>
                        <input class="input" type="password" id="fname" name="password" value="{{ Request::old('password') }}" placeholder="Nhập mật khẩu" required>
                        <label for="lname">{{ __('Nhập lại mật khẩu') }}</label>
                        <input class="input" type="password" id="lname" name="password_confirmation" value="{{ Request::old('password_confirmation') }}" placeholder="Nhâp lại mật khẩu" required>
                        <label for="lname">{{ __('Vai trò') }}</label>
                        <br><br>
                        @foreach ($roles as $role)
                            <input class="input" type="checkbox" name="roles_id[]" value="{{ $role->id }}" placeholder="Mô tả quyền">
                            <label for="vehicle1">{{ $role->display_name }}</label>
                        @endforeach
                        <label for="lname">{{ __('Menu') }}</label>
                        <br><br>
                        @foreach ($permissions as $permission)
                            <input class="input" type="checkbox" name="permission_id[]" value="{{ $permission->id }}" placeholder="Mô tả quyền">
                            <label for="vehicle1">{{ $permission->display_name }}</label>
                        @endforeach
                    </div>
                    <div class="form-submit">
                        <input type="submit" class="input button-form" value="Thêm">
                    </div>
                </form>
            </div>
          </div>
    </div>
</section>

@include('modal.success')

@endsection
