@extends('admin.index')
@section('content')

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách bàn quán nhậu') }}</h1>
        <a href="{{ route('drinking.create') }}" class="button"><i class="fa fa-plus"></i> {{ __('Thêm bàn') }}</a>
        <a class="button excel" href="">{{ __('Bàn đã thanh toán') }}</a>
        <div class="home-list">
            @if (count($drinkings))
                @foreach ($drinkings as $drinking)
                    <div class="home-wrap">
                        <div class="home-images">
                            <img src="{{ asset('backend/images/table3.jpg') }}" alt="">
                        </div>
                        <div class="home-text-details">
                            <p>{{ $drinking->name }}</p>
                            <a class="button" href="{{ route('drinking.edit', $drinking->id) }}"><i class="fa fa-edit"></i></a>
                            <a class="button modal-pubs-success modal-show-bill" data-id="{{ $drinking->id }}"><i class="fa fa-eye"></i></a>
                            <a class="button modal-pubs-delete" data-href="{{ route('drinking.delete', $drinking->id) }}"><i class="fa fa-paypal"></i> Thanh Toán</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div>KCDL</div>
            @endif
        </div>
    </div>
</section>

@include('modal.show_bill')
@include('modal.modal_delete')
@include('modal.success')
<script>
    var routeOnShow = "{{ route('drinking.onshow') }}";
</script>
<script src="{{ asset('backend/js/drinking.js') }}"></script>
@endsection
