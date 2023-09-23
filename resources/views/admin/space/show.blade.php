<x-main-layout title="Space">

    <x-alert name="success" class="alert alert-success" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h2 style="margin-top: 100px;" class="mb-5 text-center">{{ $space->name }} {{ $space->type }}</h2>

    <div class="row align-items-center">
        <div class="col-5">
            @if ($space->image)
                <img src="{{ asset('storage/' . $space->image) }}" alt="" width="100%">
            @endif
        </div>
        <div class="col-7">
            <h3>Name: {{ $space->name }}</h3>
            <h3>type: {{ $space->type }}</h3>
            <h3>capacity: {{ $space->capacity }}</h3>
            <h3 class="mb-4">assets: {{ $space->assets }}</h3>

            @if (Auth::user()->role == 'member')
                <x-bg-modal btn="Booking Now"
                    class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl" id="create">
                    <div class="modal-body p-4">
                        <h4>Make A Request</h4>
                        <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="number" style="display:none" name="user_id" value="{{ Auth::id() }}">
                            {{-- <input type="hidden" name="branch_id" value="{{ $space->branch->id }}"> --}}
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
    </div>

</x-main-layout>




















{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
