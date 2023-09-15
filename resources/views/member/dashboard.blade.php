<x-main-layout title="make a request">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-5">All Spaces</h1>
            <a href="" class="btn bg-secondary-color text-white">All Spaces</a>
        </div>
    </div>
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th scope="col">Space Name</th>
                    <th scope="col">Branch</th>
                    <th scope="col">type</th>
                    <th scope="col">capacity</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spaces as $space)
                    <tr>
                        <td>{{ $space->name }}</td>
                        <td>{{ $space->branch->name }}</td>
                        <td>{{ $space->type }}</td>
                        <td> {{ $space->capacity}}</td>
                        <td>
                            <a href="{{ route('space.show' , $space->id) }}" class="btn bg-primary-color text-white" >show</a>
                        </td>
                        <td>
                            {{-- <div class="">
                                <x-bg-modal btn="Edit" class="modal-dialog-centered modal-dialog-scrollable"
                                    id="edit{{ $space->id }}">
                                    <div class="modal-body p-4">
                                        <h4>Update space Info</h4>
                                        <form action="{{ route('space.update', $space->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            @include('admin.space._form' , [
                                                'button_lable'=>'Update',
                                            ])
                                        </form>
                                    </div>
                                </x-bg-modal>
                        
                                <x-bg-modal btn="Delete" class="modal-dialog-centered " id="delete{{$space->id}}">
                                    <div class="modal-body p-4 text-center">
                                            <h4 class="mb-2">Are You Sure ?</h4>
                                            <h5 class="text-secondary mb-3">You Will Delete {{$space->name}} space Forever .</h5>
                                            <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary mx-3"
                                                data-dismiss="modal">Close</button>
                                                <form action="{{ route('space.destroy' , $space->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                        </div>
                                    </div>
                                </x-bg-modal>
                            </div> --}}
                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-main-layout>
