<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('assets/logo.png') }}" alt="" style="border-radius: 30px">
            <h1>Gaza Sky Geeks<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                {{--@if (Auth::user())
                    @if (Auth::user()->role === 'admin')
                        <li class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}"><a  href="{{ route('admin.dashboard') }}">Dashborad</a></li>
                        <li class="{{ Route::currentRouteName() === 'users.index' ? 'active' : '' }}"><a href="{{ route('users.index') }}">Members</a></li>
                        @elseif(Auth::user()->role === 'member')
                        <li class="{{ Route::currentRouteName() === 'member.dashboard' ? 'active' : '' }}"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
                        <li  class="{{ Route::currentRouteName() === 'request.index' ? 'active' : '' }}"><a href="{{ route('request.index') }}">Your Requests</a></li>
                        @endif
                        <li class="{{ Route::currentRouteName() === 'branch.index' ? 'active' : '' }}"><a href="{{ route('branch.index') }}">Branches</a></li>
                        <li class="{{ Route::currentRouteName() === 'calender' ? 'active' : '' }}"><a href="{{ route('calender') }}">Calender</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link fs-6 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Language
                        </a>
                        <ul class="dropdown-menu">
                            <li> <a href="{{ route('change.language', ['locale' => 'en']) }}"
                                    class="nav-link">English</a>
                            </li>
                            <li> <a href="{{ route('change.language', ['locale' => 'ar']) }}"
                                    class="nav-link">Arabic</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <x-user-notifications-menu/>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-get-started">Logout</button>
                        </form>
                    </li>--}}
                {{--@elseif(!Auth::user())--}}
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Programs</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                    @if(!Auth::user())
                    <a href="{{ route('login') }}"> <button class="btn btn-get-started ms-2">Login</button></a>
                    @else
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-get-started">Logout</button>
                        </form>
                    </li>
                @endif
            </ul>
        </nav><!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
