@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách phân quyền') }}</h1>
        <a href="{{ route('permission.create') }}" class="button"><i class="fa fa-plus"></i> {{ __('Tạo mới') }}</a>
        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Tên quyền') }}</th>
                <th>{{ __('Mô tả quyền') }}</th>
                <th></th>
            </tr>
            @if(count($permissions) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
                @foreach ($permissions as $k => $permission)
                    <tr>
                        <td>{{ ++$k }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->display_name }}</td>
                        <td>
                            <div class="action">
                                <a class="button" href="{{ route('permission.edit', $permission->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="button modal-pubs-delete" data-href="{{ route('permission.delete', $permission->id) }}"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</section>

@include('modal.modal_delete')
@include('modal.success')

@endsection
