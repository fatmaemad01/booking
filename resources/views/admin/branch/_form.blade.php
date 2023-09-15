<h2 class="my-3">Create A New Branch</h2>

<x-form.form-outline>
    <label class="form-label" for="name">Company name</label>
    <x-form.input name="name" id="name" :value="$branch->name" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="location">Location</label>
    <x-form.input name="location" id="location" :value="$branch->location"  />
</x-form.form-outline>

<div class="row">
    <div class="col-6">
        <x-form.form-outline>
            <label class="form-label" for="start_time">start_time</label>
            <x-form.input type="time" name="start_time" id="start_time" :value="$branch->start_time"  />
        </x-form.form-outline>
    </div>
    <div class="col-6">
        <x-form.form-outline>
            <label class="form-label" for="end_time">end_time</label>
            <x-form.input type="time" name="end_time" id="end_time" :value="$branch->end_time"  />
        </x-form.form-outline>
    </div>
</div>

<x-form.form-outline>
    <label class="form-label" for="work_days">Work Days</label>
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle w-full" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            {{__('Select Work Days')}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            @foreach($days as $day)
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" name="work_days[]" type="checkbox" value="{{$day->id}}" id="day-{{$day->id}}" @if(in_array($day->id, old('work_days', $branch->workDays->pluck('id')->toArray()))) checked @endif>
                    <label class="form-check-label" for="day-{{$day->id}}">
                        {{$day->name}}
                    </label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</x-form.form-outline>

<button type="submit" class="btn bg-secondary-color text-white my-3">{{__("$button_lable")}}</button>
