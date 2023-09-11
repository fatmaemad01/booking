<x-main-layout title="Spaces">
    <x-nav />
    <div class="container ">
        <div class="d-flex justify-content-between">
            <h2 class="text-muted">Spaces</h2>
            <x-bg-modal btn="New Space" class="modal-dialog-scrollable" id="create">
                <div class="modal-body">
                    <form action="{{ route('space.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.space._form')
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


        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spaces as $space)
                    <tr>
                        <td>{{ $space->name }}</td>
                        <td>{{ $space->type }}</td>
                        <td> {{ $space->branch->name }}</td>
                        <td>{{ $space->capacity }}</td>
                        <td>
                            <div class="">
                                <x-bg-modal btn="Edit " class="modal-dialog-centered modal-dialog-scrollable"
                                    id="update">
                                    <div class="modal-body p-4">
                                        <h4>Update Space Info</h4>
                                        <form action="{{ route('space.update', $space->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @include('admin.space._form')
                                        </form>
                                    </div>
                                </x-bg-modal>
                                <x-bg-modal btn="Delete" class="modal-dialog-centered" id="delete">
                                    <div class="modal-body p-4">
                                        <form action="{{ route('space.destroy', $space->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <h4>Delete Space forever.</h4>
                                            <h5>Are You Sure ?</h5>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

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
