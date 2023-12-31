<x-main-layout title="Spaces">

<x-secondary-nav heading="Spaces" />

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-muted">Spaces</h2>
            @if (Auth::user()->role == 'admin')
                <x-bg-modal btn="New Space" class="modal-dialog modal-xl" id="create">
                    <div class="modal-body p-4">
                        <h2 class="text-center my-3 fw-bold">Create New Space</h2>
                        <form action="{{ route('space.store') }}" method="POST" enctype="multipart/form-data">
                            @include('admin.space._form', [
                                'btn' => 'Create Space',
                            ])
                        </form>
                    </div>
                </x-bg-modal>
            @endif
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
                            @if (Auth::user()->role == 'admin')
                                <div class="">
                                    <x-bg-modal btn="Edit " class="modal-dialog-centered modal-xl"
                                        id="edit{{ $space->id }}">
                                        <div class="modal-body p-4">
                                            <h4 class="text-center my-3 fw-bold">Update Space Info</h4>
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
                            @elseif(Auth::user()->role == 'member')
                                <a href="{{ route('space.show', $space->id) }}">Show details</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>
