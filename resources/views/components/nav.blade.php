<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('assets/logo.png') }}" alt="" style="border-radius: 30px">
            <h1>Gaza Sky Geeks<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                @if(Auth::user()->role === 'admin')
                <li><a href="{{ route('admin.dashboard')}}">Home</a></li>
                <li><a href="{{ route('space.index')}}">Spaces</a></li>
                <li><a href="{{ route('branch.index')}}">Branches</a></li>
                <li><a href="{{ route('users.index')}}">Members</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-get-started">logout</button>
                    </form>
                </li>
                @elseif(Auth::user()->role === 'member')
                <li><a href="{{ route('member.dashboard')}}">Home</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-get-started">logout</button>
                    </form>
                </li>
                @endif
            </ul>
        </nav><!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>