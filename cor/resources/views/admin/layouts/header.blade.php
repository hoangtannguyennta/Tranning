<header>
    <div class="container">
        <div class="header-right dropdown">
            <ul>
                @if (Auth::check())
                    <li>
                        <a class="header-font" href="#"> {{ Auth::user()->name}} ({{ Auth::user()->roles->first()->name ?? '' }}) <i class="fa fa-caret-down"></i></a>
                    </li>
                    <div class="dropdown-content">
                        <li><a class="header-font" href="{{ route('drinking.index') }}">{{ __('Bàn nhậu') }}</a></li>
                        <li><a class="header-font" href="{{ route('users.index') }}">{{ __('Người dùng') }}</a></li>
                        <li><a class="header-font" href="{{ route('pubs.index') }}">{{ __('Thực đơn') }}</a></li>
                        <form action="{{ route('logout') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('POST')
                            <button class="button" type="submit">{{ __('Đăng xuất') }}</button>
                            <a class="button" href="{{ route('users.edit',Auth::user()->id) }}">{{ __('Đổi mật khẩu') }}</a>
                        </form>
                    </div>
                @else
                    @if (Route::has('login'))
                        <li>
                            <a class="header-font" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li>
                            <a class="header-font" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</header>
