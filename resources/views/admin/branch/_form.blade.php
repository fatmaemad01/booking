<h2 class="my-3">Create A New Branch</h2>

<x-form.form-outline>
    <label class="form-label" for="form6Example1">Company name</label>
    <x-form.input name="name" id="form6Example1" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="form6Example2">Location</label>
    <x-form.input name="location" id="form6Example2" />
</x-form.form-outline>

<x-form.form-outline>
    <label class="form-label" for="form6Example3">Work Days</label>
    <select class="form-control" class="select"  name="Work_days[]">
        @foreach ($days as $day)
         <option>{{ $day->name }}</option>            
        @endforeach
    </select>
</x-form.form-outline>

<button type="submit" class="btn bg-secondary-color text-white">{{__("$button_lable")}}</button>
