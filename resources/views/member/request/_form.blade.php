<div class="modal-body p-4">
    <h4 class="text-center fw-bold">Make A Request</h4>
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
        <div class="d-flex justify-content-center my-3">
            <button type="submit" class="btn btn-primary" style="width: 20%">
                Create
            </button>
            <button type="button" class="btn btn-get-started  mx-3" data-dismiss="modal">Cancel</button>
        </div>
    </form>
