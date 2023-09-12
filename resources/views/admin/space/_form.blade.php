<h2>Create A New Space</h2>
<x-form.form-outline>
    <label class="form-label" for="branch_id">Branch ID</label>
    <x-form.input name="branch_id" id="branch_id" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="type">Type</label>
    <x-form.input name="type" id="type" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="name">Name</label>
    <x-form.input name="name" id="name" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="capacity">Capacity</label>
    <x-form.input type="number" name="capacity" id="capacity" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="price">Price</label>
    <x-form.input type="number" name="price" id="price" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="assets">Assets</label>
    <x-form.input name="assets" id="assets" />
</x-form.form-outline>


<x-form.form-outline>
    <label class="form-label" for="availablity">Availablity</label>
    <x-form.input name="availablity" id="availablity" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="image">image</label>
    <x-form.input type="file" name="image" id="availablity" />
</x-form.form-outline>



<button type="submit" class="btn bg-primary-color">{{__("$button_lable")}}</button>

    {{-- <div class="form-group">
        <label for="branch_id">Branch ID:</label>
        <input type="text" name="branch_id" id="branch_id" class="form-control" value="{{old('branch_id' , $space->branch_id)}}" required>
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" name="type" id="type" class="form-control"  value="{{old('type' , $space->type)}}" required>
    </div> --}}
    {{-- <div class="form-group">
        <label for="branch_id">Name:</label>
        <input type="text" name="name" id="name" class="form-control"  value="{{old('name' , $space->name)}}" required>
    </div> --}}

    {{-- <div class="form-group">
        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" class="form-control"  value="{{old('capacity' , $space->capacity)}}" required>
    </div> --}}
    {{-- <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" class="form-control" value="{{old('price' , $space->price)}}">
    </div> --}}
    {{-- <div class="form-group">
        <label for="assets">Assets:</label>
        <input type="text" name="assets" id="assets" class="form-control" value="{{old('assets' , $space->assets)}}" required>
    </div>
    <div class="form-group">
        <label for="availablity">Availability:</label>
        <input type="text" name="availablity" id="availablity" class="form-control" value="{{old('availablity' , $space->availablity)}}">
    </div> --}}

    <!-- Repeat similar fields for 'type', 'name', 'capacity', 'price', 'availability', 'assets' -->

    {{-- <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div> --}}

    {{-- <button type="submit" class="btn btn-primary">Create Space</button> --}}
