
    <x-form.form-outline>
        <label class="form-label" for="first_name">First Name</label>
        <x-form.input name="first_name" id="first_name" :value="$user->first_name" />
    </x-form.form-outline>

    <x-form.form-outline>
        <label class="form-label" for="last_name">Last Name</label>
        <x-form.input name="last_name" id="last_name" :value="$user->last_name" />
    </x-form.form-outline>
    
    <x-form.form-outline>
        <label class="form-label" for="email">Email</label>
        <x-form.input name="email" id="email" :value="$user->email" type="email" />
    </x-form.form-outline>

    <x-form.form-outline>
        <label class="form-label" for="password">Password</label>
        <x-form.input name="password" id="password" :value="$user->password" type="password"/>
    </x-form.form-outline>

    <x-form.form-outline>
        <label class="form-label" for="phone">Phone</label>
        <x-form.input name="phone" id="phone" :value="$user->phone" />
    </x-form.form-outline>


    <x-form.form-outline>
        <label class="form-label" for="locale">Change Your Language</label>
        <select name="locale" id="locale">
            <option value="">Select A Language</option>
            <option value="en">En</option>
            <option value="ar">Ar</option>
        </select>    
    </x-form.form-outline>

    <x-form.form-outline>
        <label class="form-label" for="personal_image">Perosanl Image</label>
        <x-form.input name="personal_image" id="personal_image" type="file"/>
    </x-form.form-outline>





    <button type="submit" class="btn bg-secondary-color text-white my-3">{{__("$button_lable")}}</button>
