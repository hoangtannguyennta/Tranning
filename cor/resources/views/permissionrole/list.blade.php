@extends('admin.index')
@section('content')

<div class="padding-top">
    <a href="{{ route('permission.index') }}" class="button">Trở về</a>
</div>

<section class="banner banner-table">
    <div class="container">
        <h1>{{ __('Danh sách phân quyền') }}</h1>
        <a href="{{ route('permissionRole.create') }}" class="button"><i class="fa fa-plus"></i> {{ __('Thêm quyền người dùng') }}</a>
        <table>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Vai trò') }}</th>
                <th>{{ __('Quyền') }}</th>
                <th></th>
            </tr>
            @if(count($roles) === 0)
                <tr>
                    <td>KCDL</td>
                </tr>
            @else
                @foreach ($roles as $k => $role)
                    @if (count($role->permissions))
                        <tr>
                            <td>{{ ++$k }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($role->permissions as $value)
                                        <li>(*) {{ $value->display_name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <div class="action">
                                    <a class="button" href="{{ route('permissionRole.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="button modal-pubs-delete" data-href="{{ route('permissionRole.delete', $role->id) }}"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </table>
    </div>
</section>

@include('modal.modal_delete')
@include('modal.success')

@endsection
