@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('permissionRole.index') }}" class="button">Trở về</a>
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
                <form action="{{ route('permissionRole.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên quyền :') }}</label>
                        <select class="select" name="role_id">
                            <option value="">Chọn vai trò</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected': '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="lname">{{ __('Mô tả quyền :') }}</label>
                        <br>
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
