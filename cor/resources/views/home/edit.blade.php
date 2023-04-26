@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('drinking.index') }}" class="button">Trở về</a>
</div>

<section class="banner">
    <div class="container">
        <div class="form">
            <div class="form-top">
                <h4>{{ __('Cập nhật danh sách hàng hoá') }}</h4>
            </div>
            <div class="form-bottom">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="invalid-form">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('drinking.update', $drinks->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-content">
                        <label for="fname">{{ __('Tên bàn :') }}</label>
                        <input class="input" type="text" id="fname" name="name" value="{{ old('name', $drinks->name) }}" placeholder="Nhập tên">
                    </div>
                    <p for="">{{ __('Menu :') }}</p>
                    @foreach ($pubs as $key => $pub)
                        <div class="form-checkbox">
                            <input type="checkbox" {{ in_array($pub->id, $pubs_id) ? 'checked' : ''}} value="{{ $pub->id }}" name="drinking[]">
                            <span class="checkmark">{{ $pub->product_name }} ({{ $pub->amount }})</span>
                            @foreach ($drinks->drinkingPubs as $value)
                                @if ($pub->id === $value->id)
                                    <input class="input" type="number" id="lname" name="amount[]"  value="{{ $value->pivot->amount }}" placeholder="Nhập số lượng">
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    <input type="submit" class="input button-form" value="Cập nhật">
                </form>
            </div>
          </div>
    </div>
</section>

@include('modal.success')

@endsection

