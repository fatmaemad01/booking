<x-main-layout title="Members">
<<<<<<< HEAD
=======
  
>>>>>>> dc2ced1398ba7b4c5fbeb6ae786c1998b6712623
    <div class="container pt-5">
        <div class="d-flex justify-content-between">
            <h2 class="text-muted">Members</h2>
            <x-bg-modal btn="New Member" class="modal-dialog-scrollable" id="create">
                <div class="modal-body">
                <h4>{{__('Add Member Info')}}</h4>
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        @include('admin.member._form' ,[
                        'button_lable' => 'Add Member'
                        ]
                        )
                    </form>
                </div>
            </x-bg-modal>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td> {{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <div class="">
                            <x-bg-modal btn="Edit" class="modal-dialog-centered modal-dialog-scrollable" id="update{{$user->id}}">
                                <div class="modal-body p-4">
                                    <h4>Update Member Info</h4>
                                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        @method('put')
                                        @include('admin.member._form' , [
                                        'button_lable' => 'Update Member'
                                        ])
                                    </form>
                                </div>
                            </x-bg-modal>
                            <x-bg-modal btn="Delete" class="modal-dialog-centered" id="delete{{$user->id}}">
                                <div class="modal-body p-4">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                        @method('delete')
                                        @csrf
                                        <h4>Delete Member forever.</h4>
                                        <h5>Are You Sure ?</h5>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </x-bg-modal>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>