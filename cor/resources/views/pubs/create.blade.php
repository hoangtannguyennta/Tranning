@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('pubs.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo danh sách hàng hoá') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('pubs.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="author_id" value="{{ Auth::user()->id }}">
                    <div class="form-content">
                        <label for="fname">{{ __('Tên hàng :') }}</label>
                        <input class="input" type="text" id="fname" name="product_name" value="{{ old('product_name') }}" placeholder="Nhập tên">
                        <label for="lname">{{ __('Số lượng :') }}</label>
                        <input class="input" type="number" id="lname" name="amount" value="{{ old('amount') }}" placeholder="Nhập số lượng">
                    </div>
                    <div class="form-content">
                        <label for="lname">{{ __('Giá :') }}</label>
                        <input class="input input-price" type="number" id="lname" name="price" value="{{ old('price') }}" placeholder="Nhập giá">
                        <label for="lname">{{ __('Thành viên :') }}</label>
                        <select class="select" name="user_id">
                            <option value="">Chọn thành viên nhập</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected': '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-content select-multil">
                        <label for="lname">{{ __('Thành viên sử dụng :') }}</label>
                        <select class="select" name="pubs_users[]" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ (collect(old('pubs_users'))->contains($user->id)) ? 'selected': '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="lname">{{ __('Hình ảnh') }}</label>
                    <div class="input-group hdtuto control-group lst increment" >
                        <div class="list-input-hidden-upload">
                            <input type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+ ADD</button>
                        </div>
                    </div>
                    <div class="list-images">
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
