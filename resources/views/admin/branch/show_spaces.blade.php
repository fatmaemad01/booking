<x-main-layout title="Spaces">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-muted my-5">Spaces</h2>
        </div>
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
                            @if(Auth::user()->role == 'admin')
                            <div class="">
                                <x-bg-modal btn="Edit " class="modal-dialog-centered modal-xl"
                                    id="edit{{ $space->id }}">
                                    <div class="modal-body p-5">
                                        <h4 class="text-center my-2 fw-bold">Update Space Info</h4>
                                        <form action="{{ route('space.update', $space->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @include('admin.space._form', [
                                                'btn' => 'Update Space',
                                            ])
                                        </form>
                                    </div>
                                </x-bg-modal>
                                <x-bg-modal btn="Delete" class="modal-dialog-centered "
                                    id="delete{{ $space->id }}">
                                    <div class="modal-body p-5 text-center">
                                        <form action="{{ route('space.destroy', $space->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <h4 class="mb-2">Are You Sure ?</h4>
                                            <h5 class="text-secondary mb-3">You Will Delete {{ $space->name }}
                                                {{ $space->type }} Forever.</h5>

                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-get-started mx-3" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary" >
                                                    Delete
                                                </button>
                                        </form>
                                    </div>
                                </x-bg-modal>
                            </div>
                            @elseif(Auth::user()->role == 'member')
                                <a href="{{ route('space.show' ,[$branch->id , $space->id ])}}">Show details</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>
