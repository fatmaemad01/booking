
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
        <x-form.input name="password" id="password" type="password"/>
    </x-form.form-outline>

    <x-form.form-outline>
        <label class="form-label" for="phone">Phone</label>
        <x-form.input name="phone" id="phone" :value="$user->phone" />
    </x-form.form-outline>


    <x-form.form-outline>
        <label class="form-label" for="role">Role : </label>
        <select name="role" class="form-select" id="role">
            <option value="">Select A role</option>
            <option value="admin">Admin</option>
            <option value="member">Member</option>
        </select>
    </x-form.form-outline>



<div class="d-flex justify-content-center">
    <button type="submit" class="btn-primary my-3">{{__("$button_lable")}}</button>
</div>
