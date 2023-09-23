<x-main-layout title="Branch">


    <x-alert name="success" class="alert-success mt-4" />
    <x-alert name="error" class="alert-danger" />


    <div class="d-flex justify-content-between align-items-center mb-4">
        @if (Auth::user()->role == 'admin')
            <h1 class="my-4">Branches Of Company</h1>
        @elseif(Auth::user()->role == 'member')
            <h1 class="my-4">Select The Branch</h1>
        @endif

        @if (Auth::user()->role == 'admin')
            <x-bg-modal btn="New Branch" class="modal-dialog modal-dialog-centered modal-xl" id="create">
                <div class="modal-body">
                    <form action="{{ route('branch.store') }}" method="POST">
                        <h4 class="text-center my-3 fw-bold">Create A New Branch</h4>

                        @include('admin.branch._form', [
                            'button_lable' => 'Create',
                        ])
                    </form>
                </div>
            </x-bg-modal>
        @endif
    </div>

    <div class="row">
        @foreach ($branches as $branch)
            <div class="col-md-4">
            
        <div class="card mb-4 border-0 shadow-lg" style="max-width: 23rem;">
                    <img class="card-img-top" src="{{ asset('assets/img/gsg2.jpg') }}" alt="" width="150"
                        height="200">
                    <div class="card-body py-4 px-4">
                        <h4 class="card-title text-center mb-4" style="font-weight: bold">{{ $branch->name }}</h4>
                        {{-- <p class="card-text"><span style="font-weight: bold">Location :
                                </span>{{ $branch->location }}</p>
                            <p class="card-text"><span style="font-weight: bold">Work days : </span>from
                                {{ $branch->workDays->first()->name }} to {{ $branch->workDays->last()->name }}</p>
                            <p class="card-text"><span style="font-weight: bold">Work time :
                                </span>{{ $branch->start_time }} - {{ $branch->end_time }}</p> --}}
                        <div class="text-center">
                            <a href="{{ route('branch.space.index', $branch->id) }}" class="btn btn-primary w-75">Show
                                Spaces</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            @if (Auth::user()->role == 'admin')
                                <x-bg-modal btn="Edit" class="modal-dialog modal-dialog-centered modal-xl"
                                    id="edit{{ $branch->id }}">
                                    <div class="modal-body p-4">
                                        <h4 class="text-center my-3 fw-bold">Update Branch Info</h4>
                                        <form action="{{ route('branch.update', $branch->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            @include('admin.branch._form', [
                                                'button_lable' => 'Update',
                                            ])
                                        </form>
                                    </div>
                                </x-bg-modal>

                                <x-bg-modal btn="Delete" class="modal-dialog-centered "
                                    id="delete{{ $branch->id }}">
                                    <div class="modal-body p-4 text-center">

                                        <form action="{{ route('branch.destroy', $branch->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <h4 class="mb-2">Are You Sure ?</h4>
                                            <h5 class="text-secondary mb-3">You Will Delete {{ $branch->name }} branch
                                                Forever.</h5>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-main-layout>
