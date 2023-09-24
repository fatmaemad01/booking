<x-main-layout title="Profile">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-4 p-4" style=" box-shadow: 2px 3px 7px 0px #d2d2d2;width:100%">
        <div class="row align-items-center">
            <div class="col-3">
                <div class="text-center">

                    @if ($user->personal_image ?? '')
                        <img class="rounded-circle m-auto shadow-sm" height="200" width="200"
                            src="{{ asset('storage/' . $user->personal_image) }}">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name }}&size=150"
                            class="rounded-circle shadow-lg" alt="">
                    @endif

                </div>
            </div>
            <div class="col-9">
                <h6 class="mb-2 fs-4 text-dark">{{ $user->first_name }} {{ $user->last_name }}</h6>
                <h6 class="mb-2 text-dark">Email : {{ $user->email }}</h6>
                <h6 class="mb-2 text-dark">Phone : {{ $user->phone }}</h6>
                <h6 class="mb-2 text-dark">Your Role is : {{ $user->role }}</h6>
            </div>
        </div>

        <div class="row details mt-4">
            <h4 class="mt-3 mb-3">Edit Your Information</h4>
            <form action="{{ route('profile.useredit', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('admin.member.profile._form')
                <div class="my-3">
                    <button type="submit" class="btn bg-primary-color text-white" style="width: 20%">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="rounded-4 p-4 mt-3" style=" box-shadow: 2px 3px 7px 0px #d2d2d2;width:100%">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>
    

</x-main-layout>
