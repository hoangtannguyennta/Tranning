@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật danh sách người dùng') }}</h4>
            </div>

            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('users.update',$users->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên') }}</label>
                        <input type="text" class="input" id="fname" name="name" value="{{ $users->name }}" placeholder="Nhập tên" required>
                        <label for="lname">{{ __('Email') }}</label>
                        <input type="email" class="input" id="lname" name="email" value="{{ $users->email  }}" placeholder="Nhập email" required>
                        <label for="fname">{{ __('Mật khẩu') }}</label>
                        <input type="password" class="input" id="fname" name="password"  placeholder="********">
                        <label for="lname">{{ __('Nhập lại mật khẩu') }}</label>
                        <input type="password"class="input"  id="lname" name="password_confirmation"  placeholder="********">
                        <label for="lname">{{ __('Chọn quyền :') }}</label>
                        <br><br>
                        @foreach ($roles as $role)
                            <input class="input" {{ in_array($role->id, $users_array) ? 'checked' : '' }} type="checkbox" name="roles_id[]" value="{{ $role->id }}" placeholder="Mô tả quyền">
                            <label for="vehicle1">{{ $role->display_name }}</label>
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
