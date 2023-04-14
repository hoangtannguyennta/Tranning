@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('drinking.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Tạo bàn nhậu') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('drinking.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                        <div class="form-content">
                            <label for="fname">{{ __('Chọn bàn') }}</label>
                            <input class="input" type="text" id="fname" name="name" value="{{ old('name') }}" placeholder="Nhập tên bàn">
                        </div>
                        <div class="form-content">
                            @foreach ($pubs as $pub)
                                <span class="checkmark">{{ $pub->product_name }} ({{ $pub->amount }})</span>
                                <input class="input" type="number" id="lname" name="amount[]"  value="" placeholder="Nhập số lượng">
                                <input type="hidden" value="{{ $pub->id }}" name="drinking[]">
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
