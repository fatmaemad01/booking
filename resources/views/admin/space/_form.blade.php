    @csrf

    <div class="form-group">
        <label for="branch_id">Branch:</label>
        <select class="form-select" id="branch_id" name="branch_id">
            <option value="{{ old('branch_id', $space->branch_id) }}">{{ $space->branch?->name ?? 'Select Branch' }}
            </option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="type">Space is:</label>
        <select name="type" id="type" class="form-select">
            <option value="{{ old('type', $space->type) }}">{{ $space->type ?? 'Select Type' }}</option>
            <option value="room">Room</option>
            <option value="free_space">Free Space</option>
        </select>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $space->name) }}"
            required>
    </div>
    <div class="form-group">
        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" class="form-control"
            value="{{ old('capacity', $space->capacity) }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" class="form-control"
            value="{{ old('price', $space->price) }}">
    </div>
    <div class="form-group">
        <label for="assets">Assets:</label>
        <textarea name="assets" id="assets" class="form-control" required>{{ old('assets', $space->assets) }}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">{{$btn}}</button>
