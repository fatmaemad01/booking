<!DOCTYPE html>
<html dir="{{App::isLocale('ar')? 'rtl' : 'ltr'}}" lang="{{App::currentLocale()}}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register</title>
    @if (App::currentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    @endif
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Favicons -->
    <link href="{{ asset('assets/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <main id="main" class="w-100 m-auto mt-5 shadow-lg p-4">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">

                    <div class="col-lg-3 text-center rounded-circle mb-2">
                        <img src="{{ asset('assets/logo.png') }}" alt="" width="200" height="200">
                        <h2>Gaza Sky Geeks</h2>
                    </div>

                    <div class="col-lg-4">
                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="first_name">First Name</label>
                            <x-form.input name="first_name" id="first_name" type="text" :value="old('first_name')" required autofocus autocomplete="first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </x-form.form-outline>

                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="last_name">Last Name</label>
                            <x-form.input name="last_name" id="last_name" type="text" :value="old('last_name')" required autofocus autocomplete="last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </x-form.form-outline>

                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="password">password</label>
                            <x-form.input name="password" id="password" type="password" :value="old('password')" required autofocus autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </x-form.form-outline>

                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <x-form.input name="password_confirmation" id="password_confirmation" type="password" required autofocus autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </x-form.form-outline>
                    </div>


                    <div class="col-lg-5">
                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="email">Email</label>
                            <x-form.input name="email" id="email" type="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </x-form.form-outline>

                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="phone">Phone</label>
                            <x-form.input name="phone" id="phone" type="text" :value="old('phone')" required autofocus autocomplete="phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </x-form.form-outline>

                        <x-form.form-outline class="w-75 m-auto">
                            <label class="form-label" for="role">Role : </label>
                            <select name="role" id="role" class="w-50">
                                <option value="">Select An role</option>
                                <option value="admin" name="admin">Admin</option>
                                <option value="member" name="member">Member</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </x-form.form-outline>


                        <div class="d-flex flex-column text-center mt-4">
                            <a class="text-secondary" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn-get-started m-auto mt-4">Register</button>
                        </div>

                   </div>



                </div>
            </form>
        </main>
    </div>



    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>