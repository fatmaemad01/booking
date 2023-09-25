@csrf
<div class="row">
    <div class="col-md-6">
        <x-form.form-outline>
            <label class="form-label" for="name">Branch Name</label>
            <x-form.input name="name" id="name" :value="old('name',$branch->name)" />
        </x-form.form-outline>
    </div>
    <div class="col-md-6">
        <x-form.form-outline>
            <label class="form-label" for="location">Location</label>
            <x-form.input name="location" id="location" :value="old('location',$branch->location)" />
        </x-form.form-outline>
    </div>
</div>



<div class="row">
    <div class="col-6">
        <x-form.form-outline>
            <label class="form-label" for="start_time">Open At</label>
            <x-form.input type="time" name="start_time" id="start_time" :value="old('start_time',$branch->start_time)" />
        </x-form.form-outline>
    </div>
    <div class="col-6">
        <x-form.form-outline>
            <label class="form-label" for="end_time">Close At</label>
            <x-form.input type="time" name="end_time" id="end_time" :value="old('end_time',$branch->end_time)" />
        </x-form.form-outline>
    </div>
</div>

<x-form.form-outline>
    <label class="form-label" for="work_days">Work Days</label>
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle w-full" type="button" id="dropdownMenuButton2"
            data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('Select Work Days') }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            @foreach ($days as $day)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" name="work_days[]" type="checkbox" value="{{ $day->id }}"
                            id="day-{{ $day->id }}" @if (in_array($day->id, old('work_days', $branch->workDays->pluck('id')->toArray()))) checked @endif>
                        <label class="form-check-label" for="day-{{ $day->id }}">
                            {{ $day->name }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-form.form-outline>
<div class="d-flex justify-content-center my-3">
    <button type="submit" class="btn btn-primary" style="width: 20%">
        {{ $button_lable }}
    </button>
    <button type="button" class="btn btn-secondary-color  mx-3" data-dismiss="modal">Cancel</button>
</div>
