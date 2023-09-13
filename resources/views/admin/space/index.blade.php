<x-main-layout title="Spaces">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-muted">Spaces</h2>
            <x-bg-modal btn="New Space" class="modal-dialog modal-xl" id="create">
                <div class="modal-body p-5">
                    <h2 class="text-center my-2 fw-bold">Create New Space</h2>
                    <form action="{{ route('space.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.space._form', [
                            'btn' => 'Create Space',
                        ])
                    </form>
                </div>
            </x-bg-modal>
        </div>

        {{-- <div class="">
            <h2>Booking Request</h2>
            @foreach ($books as $book)
                <h4 >Request By: {{ $book->user->first_name }} {{ $book->user->last_name }}</h4>
                start time : {{ $book->start_time }}
                end time : {{ $book->end_time }}
                date : {{ $book->start_date }}
            @endforeach
        </div> --}}
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>
