<x-main-layout title="Profile">
<x-nav />
    <div class="container pt-1 shadow-lg">

        <div class="content w-75 m-auto rounded text-center p-2 d-flex justify-content-between">

            <div class="m-auto h-50 w-50">
                @if($user->personal_image ?? '')
                <img class="rounded-circle m-auto" height="240" width="240" src="{{asset('storage/'. $user->personal_image)}}">
                @else
                <img src="https://ui-avatars.com/api/?name={{auth()->user()->first_name}}&size=200" class="rounded-circle mb-2" alt="">
                @endif
                <h4 class="mt-1">{{$user->first_name}}</h4>
            </div>

            <div class="rounded text-start w-50 m-auto p-3">
                <h3 class="mb-4">Personal Detail</h3>
                <h6 class="mb-4">Email : {{$user->email}}</h6>
                <h6 class="mb-4">Phone : {{$user->phone}}</h6>
                <h6 class="mb-4">Your Role is : {{$user->role}}</h6>
                <x-bg-modal btn="Edit your profile" class="modal-dialog-centered modal-dialog-scrollable" id="update{{$user->id}}">
                    <div class="modal-body p-4">
                        <h4>Update Your Info</h4>
                        <form action="{{ route('profile.useredit', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('admin.member.profile._form' , [
                            'button_lable' => 'Update Info'
                            ])
                        </form>
                    </div>
                </x-bg-modal>
            </div>

        </div>


    </div>

</x-main-layout>