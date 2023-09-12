@csrf
<div class="row">
    <div class="col-6">
        <x-form.form-outline>
            <label class="form-label" for="name">Name</label>
            <x-form.input name="name" id="name" value="{{ old('name', $space->name) }}" />
        </x-form.form-outline>
        <x-form.form-outline>
            <label class="form-label" for="branch_id">Branch</label>
            <select class="form-select {{ $errors->has('branch_id') ? 'is-invalid' : '' }}" id="branch_id"
                name="branch_id">
                <option value="{{ old('branch_id', $space->branch_id) }}">{{ $space->branch?->name ?? 'Select Branch' }}
                </option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
            <x-error-message name="branch_id" />
        </x-form.form-outline>
        <x-form.form-outline>
            <label class="form-label" for="assets">Assets</label>
            <textarea rows="5" name="assets" id="assets" class="form-control">{{ old('assets', $space->assets) }}</textarea>
            <x-error-message name="assets" />
        </x-form.form-outline>
    </div>
    <div class="col">
        <x-form.form-outline>
            <label class="form-label" for="type">Type</label>
            <select name="type" id="type" class="form-select  {{ $errors->has('type') ? 'is-invalid' : '' }}">
                <option value="{{ old('type', $space->type) }}">{{ $space->type ?? 'Select Type' }}</option>
                <option value="room">Room</option>
                <option value="free_space">Free Space</option>
            </select>
            <x-error-message name="type" />
        </x-form.form-outline>
        <div class="row">
            <div class="col-6">
                <x-form.form-outline>
                    <label class="form-label" for="price">Price</label>
                    <x-form.input type="number" name="price" id="price"
                        value="{{ old('price', $space->price) }}" />
                </x-form.form-outline>

            </div>
            <div class="col-6">
                <x-form.form-outline>
                    <label class="form-label" for="capacity">Capacity</label>
                    <x-form.input type="number" name="capacity" id="capacity"
                        value="{{ old('name', $space->capacity) }}" />
                </x-form.form-outline>
            </div>
        </div>


        <div class="row">
            <div class="col-6">
                <x-form.form-outline>
                    <label class="form-label" for="availablity">Available From:</label>
                    <x-form.input name="available_from" id="available_from" type="time" />
                </x-form.form-outline>
            </div>
            <div class="col-6">
                <x-form.form-outline>
                    <label class="form-label" for="availablity">To: </label>
                    <x-form.input name="available_to" id="available_to" type="time" />
                </x-form.form-outline>
            </div>
        </div>
        <x-form.form-outline>
            <label class="form-label" for="image">image</label>
            <x-form.input type="file" name="image" id="image" />
        </x-form.form-outline>


    </div>
    <div class="d-flex justify-content-center my-3">
        <button type="submit" class="btn btn-primary" style="width: 40%">
            {{ $btn }}
        </button>
    </div>
</div>
