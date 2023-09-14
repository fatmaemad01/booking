@csrf
<div class="row">
    <div class="col-12">
        <x-form.form-outline>
            <label class="form-label" for="space_id">Space</label>
            <select class="form-select {{ $errors->has('space_id') ? 'is-invalid' : '' }}" id="space_id"
                name="space_id">
                @foreach ($spaces as $space)
                    <option value="{{ $space->id }}">{{ $space->name }}</option>
                @endforeach
            </select>
            <x-error-message name="space_id" />
        </x-form.form-outline>
    </div>

    <div class="col">
        <div class="row">
            <div class="col-6">
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
                    <button class="btn btn-outline-secondary dropdown-toggle w-full" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('Select Days')}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        @foreach($days as $day)
                        <li class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" name="days[]" type="checkbox" value="{{$day->id}}" id="day-{{$day->id}}" @if($request->days->contains($day->id)) checked @endif>
                                <label class="form-check-label" for="day-{{$day->id}}">
                                    {{$day->name}}
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
            </x-form.form-outline>
            
        </div>
    
    <div class="d-flex justify-content-center my-3">
        <button type="submit" class="btn btn-primary" style="width: 40%">
            Create
        </button>
    </div>
</div>
