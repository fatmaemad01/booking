<h2 class="my-3">Create A New Branch</h2>

<x-form.form-outline>
    <label class="form-label" for="name">Company name</label>
    <x-form.input name="name" id="name" :value="$branch->name" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="location">Location</label>
    <x-form.input name="location" id="location" :value="$branch->location"  />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="work_days">Work Days</label>
    @foreach ($days as $day)
        <label class="dropdown-item">
            <input type="checkbox" name="work_days[]" value="{{ $day->id }}"
                @if($branch->workDays->contains($day->id)) checked @endif>
            {{ $day->name }}
            @if($branch->workDays->contains($day->id))
                <i class="fas fa-check"></i>
            @endif
        </label>
    @endforeach
</x-form.form-outline>



<button type="submit" class="btn bg-secondary-color text-white my-3">{{__("$button_lable")}}</button>
