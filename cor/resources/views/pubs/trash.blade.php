@extends('admin.index')
@section('content')

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách hàng hoá đã xóa') }}</h1>
        <div class="banner-table-top">
            <div class="banner-table-top-left">
                <a class="button" href="{{ route('pubs.index') }}">{{ __('Trở về') }}</a>
            </div>
            <div class="banner-table-top-right">
                <form action="{{ route('pubs.trash') }}">
                    <input class="input-banner" type="text" name="keyword" value="{{ $keyword }}">
                    <input class="input-banner" type="date" name="start_date" value="{{ $start_date_value }}">
                    <input class="input-banner" type="date" name="end_date" value="{{ $end_date  }}">
                    <select class="select-banner"  name="users" id="">
                        <option value="">Chọn người dùng</option>
                        @foreach ($users_value as $user)
                            <option {{ $user->id == $users ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button class="button" type="submit">{{ __('Tìm kiếm') }}</button>
                </form>
            </div>
        </div>
        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Ảnh') }}</th>
                <th>{{ __('Tên sản phẩm') }}</th>
                <th>{{ __('Số lượng') }}</th>
                <th>{{ __('Giá cả') }}</th>
                <th>{{ __('T.Tiền') }}</th>
                <th>{{ __('Chức năng') }}</th>
            </tr>
            @if(count($pubs) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
            @foreach ($pubs as $k => $pub)
                <tr>
                    <td>{{ ++$k }}</td>
                    <td class="pubs-list-img">
                        @foreach (json_decode($pub->images,true) as $image)
                            <img src="../files_pubs/{{ $image }}">
                        @endforeach
                    </td>
                    <td>{{ $pub->product_name }}</td>
                    <td>{{ $pub->amount }}</td>
                    <td>{{ number_format( $pub->price )}}</td>
                    <td>{{ number_format( $pub->price * $pub->amount )}}</td>
                    <td>
                        <div class="action">
                            <a class="button modal-pubs-success"
                                data-product_name = "{{ $pub->product_name }}"
                                data-amount = "{{ $pub->amount }}"
                                data-price = "{{ $pub->price }}"
                                data-total = "{{ $pub->price * $pub->amount }}"
                                data-images = "{{ $pub->images }}"
                                data-user = "{{ $pub->users->name }}"
                                data-users = "{{ $pub->pubsUsers->pluck('name') }}"
                                data-created_at = "{{ $pub->created_at }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="button" href="{{ route('pubs.record',$pub->id) }}"><i class="fa fa-undo"></i></a>
                            <a class="button modal-pubs-delete" data-href="{{ route('pubs.forceDelete',$pub->id) }}"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        </table>
    </div>
</section>

@include('modal.modal_delete');
@include('modal.success')

@endsection
