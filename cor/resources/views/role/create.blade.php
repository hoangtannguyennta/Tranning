@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('role.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo quyền') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('role.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên vai trò :') }}</label>
                        <input class="input" type="text" id="fname" name="name" value="{{ old('name') }}" placeholder="Nhập vai trò">
                        <label for="lname">{{ __('Mô tả vai trò :') }}</label>
                        <input class="input" type="text" id="lname" name="display_name" value="{{ old('display_name') }}" placeholder="Mô tả vai trò">
                        <label for="lname">{{ __('Chọn quyền :') }}</label>
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
