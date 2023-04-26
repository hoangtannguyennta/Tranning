@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('permission.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật danh sách hàng hóa') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('permission.update', $permissions->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên quyền :') }}</label>
                        <input class="input" type="text" id="fname" name="name" value="{{ old('name', $permissions->name) }}" placeholder="Nhập tên quyền">
                        <label for="lname">{{ __('Mô tả quyền :') }}</label>
                        <input class="input" type="text" id="lname" name="display_name" value="{{ old('display_name', $permissions->display_name) }}" placeholder="Mô tả quyền">
                    </div>
                    <div class="form-submit">
                        <input type="submit" class="input button-form" value="Cập nhật">
                    </div>
                </form>
            </div>
          </div>
    </div>
</section>

@include('modal.success')

@endsection
