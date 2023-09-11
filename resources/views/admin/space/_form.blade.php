    @csrf
    <div class="form-group">
        <label for="branch_id">Branch ID:</label>
        <input type="text" name="branch_id" id="branch_id" class="form-control" value="{{old('branch_id' , $space->branch_id)}}" required>
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" name="type" id="type" class="form-control"  value="{{old('type' , $space->type)}}" required>
    </div>
    <div class="form-group">
        <label for="branch_id">Name:</label>
        <input type="text" name="name" id="name" class="form-control"  value="{{old('name' , $space->name)}}" required>
    </div>

    <div class="form-group">
        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" class="form-control"  value="{{old('capacity' , $space->capacity)}}" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" class="form-control" value="{{old('price' , $space->price)}}">
    </div>
    <div class="form-group">
        <label for="assets">Assets:</label>
        <input type="text" name="assets" id="assets" class="form-control" value="{{old('assets' , $space->assets)}}" required>
    </div>
    <div class="form-group">
        <label for="availablity">Availability:</label>
        <input type="text" name="availablity" id="availablity" class="form-control" value="{{old('availablity' , $space->availablity)}}">
    </div>

    <!-- Repeat similar fields for 'type', 'name', 'capacity', 'price', 'availability', 'assets' -->

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Create Space</button>
