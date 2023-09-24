<x-main-layout title="Spaces">

<x-secondary-nav heading="{{ $branch->name }} Spaces" />

    <x-alert name="success" class="alert alert-success my-3" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <h1 class="d-flex"></h1>
        @if (Auth::user()->role == 'admin')
            <x-bg-modal btn="New Space" icon="fa-plus" btnClass="btn-primary" class="modal-dialog modal-xl" id="create">
                <div class="modal-body p-4">
                    <h2 class="text-center my-3 fw-bold">Create New Space</h2>
                    <form action="{{ route('branch.space.store', $branch->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @include('admin.space._form', [
                            'btn' => 'Create Space',
                        ])
                    </form>
                </div>

            </x-bg-modal>
        @endif
    </div>


    <div class="row mb-4">
        @foreach ($spaces as $space)
            <div class="col-md-3">
                <div class="card mb-4 border-0 shadow-lg" style="max-width: 20rem;">
                    <img class="card-img-top" src="{{ asset('storage/' . $space->image) }}" alt="" height="150">
                    <div class="card-body py-4 px-4">
                        <h4 class="card-title mb-4" style="font-weight: bold">{{ $space->name }}</h4>
                        @if (Auth::user()->role == 'member')
                            <x-bg-modal btn="Booking Now"
                                class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl"
                                id="create{{ $space->id }}">
                                <div class="modal-body p-4">
                                    {{-- <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
                                    @include('member.request._form', [
                                        'btn' => 'Book',
                                    ])
                                    </form>
                                </div>
                            </x-bg-modal>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        @if (Auth::user()->role == 'admin')
                            <div class="">
                                <x-bg-modal btn="Edit " class="modal-dialog-centered modal-xl"
                                    id="edit{{ $space->id }}">
                                    <div class="modal-body p-4">
                                        <h4 class="text-center my-3 fw-bold">Update Space Info</h4>
                                        <form action="{{ route('branch.space.update',  [$branch->id,$space->id]) }}" method="POST"
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
                                        <form action="{{ route('branch.space.destroy', [$branch->id,$space->id]) }}" method="POST">
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
                        {{-- @elseif(Auth::user()->role == 'member')
                            <a href="{{ route('space.show', $space->id) }}">Show details</a> --}}
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-main-layout>

{{-- <div class="row mb-4">
    <div class="col-6">
        {{ $space->name}}
    </div>
    <div class="col-6">
        @if (Auth::user()->role == 'member')
        <x-bg-modal btn="Booking Now"
            class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl" id="create">
            <div class="modal-body p-4">
                <h4>Make A Request</h4>
                <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="number" style="display:none" name="user_id" value="{{Auth::id()}}">
                    <div class="col">
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="space_id" value="{{ $space->id }}">
                                <x-form.form-outline>
                                    <label class="form-label" for="start_date">Start Date:</label>
                                    <x-form.input name="start_date" id="start_date" type="date" />
                                </x-form.form-outline>
                            </div>
                            <div class="col-6">
                                <x-form.form-outline>
                                    <label class="form-label" for="end_date">End Date </label>
                                    <x-form.input name="end_date" id="end_date" type="date" />
                                </x-form.form-outline>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <x-form.form-outline>
                                    <label class="form-label" for="start_time">Start Time:</label>
                                    <x-form.input name="start_time" id="start_time" type="time" />
                                </x-form.form-outline>
                            </div>
                            <div class="col-6">
                                <x-form.form-outline>
                                    <label class="form-label" for="end_time">End Time</label>
                                    <x-form.input name="end_time" id="end_time" type="time" />
                                </x-form.form-outline>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <x-form.form-outline>
                            <label class="form-label" for="work_days">Days</label>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle w-full" type="button"
                                    id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Select Days') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    @foreach ($space->branch->workDays as $day)
                                        <li class="dropdown-item">
                                            <div class="form-check">
                                                <input class="form-check-input" name="days[]" type="checkbox"
                                                    value="{{ $day->name }}" id="day-{{ $day->name }}">
                                                <label class="form-check-label" for="day-{{ $day->name }}">
                                                    {{ $day->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </x-form.form-outline>
                    </div>
                    <button type="submit" class="btn bg-secondary-color my-3 text-secondary">create</button>

                </form>
            </div>
        </x-bg-modal>
    @endif
    </div>
</div> --}}
