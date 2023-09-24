<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Sidebar</title>

    <!-- Include Bootstrap CSS (You can adjust the URLs to your setup) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        /* Custom styles for the sidebar */
        .sidebar {
            height: 95%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #6ca9be;
            padding-top: 20px;
            border-radius: 15px;
            margin: 15px;
            /* margin-bottom: 120px */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 17px;
            color: #f8f9fa;
            display: block;
            transition: all 0.2s;
        }

        .sidebar .btn {
            padding: 0px 15px;
            text-decoration: none;
            font-size: 17px;
            color: #f8f9fa;
            display: block;
            transition: all 0.2s;
        }

        .sidebar .btn:hover {
            font-weight: bold;
        }

        .sidebar a:hover {
            background-color: #c05934;
            font-weight: bold
        }

        .sidebar-heading {
            padding: 10px 15px;
            font-size: 25px;
            color: #ffffff;
        }

        .icon-text {
            display: flex;
            align-items: center;
        }

        .icon-text i {
            margin-right: 100px;
        }

        .content {
            margin-left: 250px;
            /* padding: 20px; */
        }

        .fas {
            padding: 30px !important;
        }

        img {
            border-radius: 50%;
            margin-left: 31px;
            margin-bottom: 17px;
            margin-top: 17px;

        }

        hr {
            color: #fff;
            border: #fff 1px solid
        }

        nav .navbar {
            background-color: #6ca9be !important;
        }

        h6 {
            padding-left: 31px;
            color: #fff
        }

        .social-links a {
            font-size: 15px;
            /* margin-top: 40px */
        }

        .social-links a:hover {
            border-radius: 50%
        }

        hr .social-links .hr {
            color: #fff;
            border: #fff 1px solid;
            margin-bottom: 0px;
        }

    </style>
</head>

<body>

    <div class="sidebar">
        <img src="{{ asset('assets/logo.png') }}" alt="" height="70px" width="70px">
        <h6 class="fw-bold  ">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
        <h6 style="font-size: 14px">GSG {{ Auth::user()->role }}</h6>
        <hr>
        <a href="{{ route('calender') }}" class="icon-text ms-3"><i class="fas fa-calendar"></i></i><span
                class="ms-4">Calendar</span></a>
        <a href="" class="icon-text ms-3"><i class="fas fa-map"></i> <span class="ms-3">Spaces</span></a>
        <a href="{{ route('branch.index') }}" class="icon-text ms-3"><i class="fas fa-code-branch"></i></i> <span
                class="ms-4">Branches</span></a>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="icon-text ms-3"><i class="fas fa-eye"></i><span
                    class="ms-4">Requests</span></a>

            <a href="{{ route('users.index') }}" class="icon-text ms-3"><i class="fas fa-users"></i> <span
                    class="ms-3">Members</span></a>
        @elseif (Auth::user()->role == 'member')
            <a href="{{ route('admin.dashboard') }}" class="icon-text ms-3"><i class="fas fa-eye"></i><span
                    class="ms-4">Your Request</span></a>
        @endif
        {{-- <x-user-notifications-menu /> --}}
        <a class="icon-text text-white ms-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn"> <i class="fas fa-sign-out-alt"></i> <span
                        class="ms-3">Logout</span></button>
            </form>
        </a>
        <hr class="mt-4">

        <div class="social-links d-flex ms-4">
            <a href="https://www.youtube.com/user/GazaSkyGeeks" class="youtube"><i class="bi bi-youtube"></i></a>
            <a href="https://www.facebook.com/GazaSkyGeeks/" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/gazaskygeeks/" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/company/gaza-sky-geeks/" class="linkedin"><i
                    class="bi bi-linkedin"></i></a>
        </div>
    </div>

    <div class="content">
        <nav class="navbar navbar-light bg-light d-flex justify-content-between ps-3 ">
            {{--
            <form action="{{ URL::current() }}" method="get" class="d-flex me-3">
                <input type="text" placeholder="{{ __('Search') }}" name="search"
                    style="border-radius: 20px; border:none" class="form-control ps-4 me-1">
                <button class="btn" style="background-color: #e06436; border-radius: 20px" type="submit"><i
                        class="fas fa-search text-white"></i></button>

            </form> --}}
        </nav>
        {{ $slot }}
    </div>

    <!-- Include Font Awesome for icons (You can adjust the URLs to your setup) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Include Bootstrap JS (You can adjust the URLs to your setup) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>