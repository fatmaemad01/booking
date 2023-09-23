<x-main-layout title="Branch">


    @if (Auth::user()->role == 'admin')
            <x-bg-modal btn="Edit" class="modal-dialog modal-dialog-centered modal-xl" id="edit{{ $branch->id }}">
                <div class="modal-body p-4">
                    <h4 class="text-center my-3 fw-bold">Update Branch Info</h4>
                    <form action="{{ route('branch.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('admin.branch._form', [
                            'button_lable' => 'Update',
                        ])
                    </form>
                </div>
            </x-bg-modal>

            <x-bg-modal btn="Delete" class="modal-dialog-centered " id="delete{{ $branch->id }}">
                <div class="modal-body p-4 text-center">

                    <form action="{{ route('branch.destroy', $branch->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <h4 class="mb-2">Are You Sure ?</h4>
                        <h5 class="text-secondary mb-3">You Will Delete {{ $branch->name }} branch Forever.</h5>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success me-4 ">
                                <i class="fas fa-check fs-4"></i>
                            </button>

                            <button type="button" class="btn btn-danger " data-dismiss="modal"><i
                                    class="fas fa-times fs-4"></i>
                            </button>
                        </div>
                    </form>
                </div>
        </x-bg-modal>
        </div>
    @endif

</x-main-layout>
