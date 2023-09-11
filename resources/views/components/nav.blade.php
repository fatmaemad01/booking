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
                <li><a href="{{ route('space.index')}}">Spaces</a></li>
                <li><a href="{{ route('branch.index')}}">Branches</a></li>
                <li><a href="#services">Requests</a></li>
                <li><a href="#team">Members</a></li>
                <li><a href="#contact" class="btn btn-logout">Logout</a></li>
            </ul>
        </nav><!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
