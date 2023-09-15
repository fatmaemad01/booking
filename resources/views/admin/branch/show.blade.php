<x-main-layout title="Branch">
 

    @if(Auth::user()->role == "admin")
    <div class="">
        <x-bg-modal btn="Edit" class="modal-dialog-centered modal-dialog-scrollable"
            id="edit{{ $branch->id }}">
            <div class="modal-body p-4">
                <h4>Update Branch Info</h4>
                <form action="{{ route('branch.update', $branch->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('admin.branch._form' , [
                        'button_lable'=>'Update',
                    ])
                </form>
            </div>
        </x-bg-modal>

        <x-bg-modal btn="Delete" class="modal-dialog-centered " id="delete{{$branch->id}}">
            <div class="modal-body p-4 text-center">
                    <h4 class="mb-2">Are You Sure ?</h4>
                    <h5 class="text-secondary mb-3">You Will Delete {{$branch->name}} branch Forever .</h5>
                    <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary mx-3"
                        data-dismiss="modal">Close</button>
                        <form action="{{ route('branch.destroy' , $branch->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </div>
            </div>
        </x-bg-modal>
    </div>
    @endif

</x-main-layout>