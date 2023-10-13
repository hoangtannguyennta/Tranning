@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('drinking.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Thêm mới') }}</h4>
            </div>
            <div class="form-bottom">
                <form action="{{ route('drinking.store') }}" id="form-submit-drinking" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                        <div class="form-content">
                            <label for="fname">{{ __('Nhập bàn') }}</label>
                            <input class="input" type="text" id="fname" name="name" value="{{ old('name') }}" placeholder="Nhập tên bàn">
                        </div>
                        <div class="form-content form-select-drinking">
                            <label for="fname">{{ __('Menu') }}</label>
                            <select class="select" name="drinking[]" id="drinking_select">
                                <option>Lựa chọn Menu</option>
                                @foreach ($pubs as $pub)
                                    <option value="{{ $pub->id }}">{{ $pub->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-content total-drinking-css">
                            <label for="fname"></label>
                            <div style="text-align: right">
                                <label for="">Tổng tiền hóa đơn</label>
                                <div>
                                    <label class="total-drink" style="color: red">
                                        0 ₫
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <label for="lname">{{ __('Hình ảnh') }}</label>
                        <div class="input-group hdtuto control-group lst increment" >
                            <div class="list-input-hidden-upload">
                                <input type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+ Chọn hình ảnh</button>
                            </div>
                        </div>
                        <div class="list-images">
                        </div>
                        <div class="form-submit">
                            <input type="submit" class="input button-form" value="Thêm mới">
                        </div>
                </form>
            </div>
          </div>
    </div>
</section>
@include('modal.success')
@include('modal.amount')
<script>
    var routeAjaxOnchange = "{{ route('drinking.onchange') }}";
    var routeOnchangeValidation = "{{ route('drinking.onchangeValidation') }}";
</script>
<script src="{{ asset('backend/js/drinking.js') }}"></script>
@endsection
