@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('drinking.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật') }}</h4>
            </div>
            <div class="form-bottom">
                <form action="{{ route('drinking.update', $drinks->id) }}" id="form-submit-drinking" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Nhập bàn') }}</label>
                        <input class="input" type="text" id="fname" name="name" value="{{ old('name', $drinks->name) }}" placeholder="Nhập tên">
                    </div>
                    <div class="form-content form-select-drinking">
                        <label for="fname">{{ __('Menu') }}</label>
                        @php
                            $idDrinks = $drinks->drinkingPubs->pluck('id')->toArray();
                        @endphp
                        <select class="select" name="drinking[]" id="drinking_select">
                            <option>Lựa chọn Menu</option>
                            @foreach ($pubs as $pub)
                                <option {{ in_array($pub->id, $idDrinks) ? 'disabled' : '' }} value="{{ $pub->id }}">{{ $pub->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($drinks->drinkingPubs as $value)
                        <div data-form-id="{{ $value->id }}" class="form-content render-form">
                            <label class="title_drinking" for="fname">Huda</label>
                            <input min="1" data-price="{{ $value->price }}" data-id-amount="{{ $value->id }}" class="input drinking_amount" type="number" id="lname" name="amount[{{ $value->id }}]" value="{{ $value->pivot->amount }}" placeholder="Nhập số lượng">
                            <img class="image-drinking" src="{{ asset('files_pubs/'. json_decode($value->images)[0]) }}">
                            <label data-price="{{ $value->price }}" class="price_total" for="fname">{{ number_format($value->price, 0, '', ',') }} ₫</label>
                            <br>
                            <a data-price="{{ $value->price }}" data-id="{{ $value->id }}" class="button button_delete">Xóa</a>
                        </div>
                    @endforeach
                    <br>
                    <div class="form-content total-drinking-css">
                        <label for="fname"></label>
                        <div style="text-align: right">
                            <label for="">Tổng tiền hóa đơn</label>
                            <div>
                                <label class="total-drink" style="color: red">
                                    {{ number_format($drinks->total, 0, '', ',') }} ₫
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
                        @if (!empty($drinks->images))
                            @foreach (json_decode($drinks->images) as $key => $img)
                                <div class="box-image">
                                    <input type="hidden" name="images_uploaded[]" value="{{ $img }}" id="img-{{ $key }}">
                                    <img src="{{ asset('images/drinking/' . $img) }}" alt="">
                                    <div class="wrap-btn-delete btn-delete-image"><span data-id="img-{{ $key }}">x</span></div>
                                </div>
                            @endforeach
                            <input type="hidden" name="images_uploaded_origin" value="{{ $drinks->images }}">
                            <input type="hidden" name="id" value="{{ $drinks->id }}">
                        @endif
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
@include('modal.errorrs')
@include('modal.amount')
<script>
    var routeAjaxOnchange = "{{ route('drinking.onchange') }}";
    var routeOnchangeValidation = "{{ route('drinking.onchangeValidation') }}";
</script>
<script src="{{ asset('backend/js/drinking.js') }}"></script>
@endsection

