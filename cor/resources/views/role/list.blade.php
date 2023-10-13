@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('users.index') }}" class="button">Trở về</a>
</div>

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách vai trò') }}</h1>
        <a href="{{ route('role.create') }}" class="button"><i class="fa fa-plus"></i> {{ __('Tạo mới') }}</a>

        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Tên vai trò') }}</th>
                <th>{{ __('Mô tả vai trò') }}</th>
                <th>{{ __('Quyền') }}</th>
                <th></th>
            </tr>
            @if(count($roles) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
                @foreach ($roles as $k => $role)
                    <tr>
                        <td>{{ ++$k }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                            <ul>
                                @foreach ($role->permissions as $value)
                                    <li>(*) {{ $value->display_name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <div class="action">
                                <a class="button" href="{{ route('role.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="button modal-pubs-delete" data-href="{{ route('role.delete', $role->id) }}"><i class="fa fa-trash-o"></i></a>
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
