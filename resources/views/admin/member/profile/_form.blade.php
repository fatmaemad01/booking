<div class="row">
    <div class="col-md-6">
        <x-form.form-outline>
            <label class="form-label" for="first_name">First Name</label>
            <x-form.input name="first_name" id="first_name" :value="$user->first_name" />
        </x-form.form-outline>
        <x-form.form-outline>
            <label class="form-label" for="email">Email</label>
            <x-form.input name="email" id="email" :value="$user->email" type="email" />
        </x-form.form-outline>
        <x-form.form-outline>
        <label class="form-label" for="locale">Change Your Language</label>
        <select name="locale" id="locale" class="form-control">
            <option value="">Select A Language</option>
            <option value="en">En</option>
            <option value="ar">Ar</option>
        </select>    
    </x-form.form-outline>

    </div>
    <div class="col-md-6">
        <x-form.form-outline>
            <label class="form-label" for="last_name">Last Name</label>
            <x-form.input name="last_name" id="last_name" :value="$user->last_name" />
        </x-form.form-outline>
        <x-form.form-outline>
            <label class="form-label" for="phone">Phone</label>
            <x-form.input name="phone" id="phone" :value="$user->phone" />
        </x-form.form-outline>
        <x-form.form-outline>
            <label class="form-label" for="personal_image">Personal Image</label>
            <x-form.input name="personal_image" type="file" id="personal_image" :value="$user->personal_image" />
        </x-form.form-outline>
    </div>
</div>

    
    