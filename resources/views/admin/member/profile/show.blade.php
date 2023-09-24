<x-main-layout title="Profile">




    <div class="container w-75 mt-4 shadow-lg rounded-4 p-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row align-items-center">
            <div class="col-3">
                <div class="text-center">

                    @if($user->personal_image ?? '')
                    <img class="rounded-circle m-auto shadow-sm" height="200" width="200" src="{{asset('storage/'. $user->personal_image)}}">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{auth()->user()->first_name}}&size=150" class="rounded-circle shadow-lg" alt="">
                    @endif

                </div>
            </div>
            <div class="col-9">
                <h6 class="mb-2 fs-4 text-dark">{{$user->first_name}} {{$user->last_name}}</h6>
                <h6 class="mb-2 text-dark">Email : {{$user->email}}</h6>
                <h6 class="mb-2 text-dark">Phone : {{$user->phone}}</h6>
                <h6 class="mb-2 text-dark">Your Role is : {{$user->role}}</h6>
            </div>
        </div>


        <div class="row details mt-4">
            <h4 class="mt-3 mb-3">Edit Your Information</h4>
            <form action="{{ route('profile.useredit', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('admin.member.profile._form')
                <div class="d-flex justify-content-center my-3">
                    <button type="submit" class="btn btn-primary" style="width: 20%">
                        Update
                    </button>
                </div>
            </form>
        </div>

</x-main-layout>