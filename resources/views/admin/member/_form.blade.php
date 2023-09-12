    @csrf
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" class="form-control"  value="{{old('first_name' , $user->first_name)}}" required>
    </div>

    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" class="form-control"  value="{{old('last_name' , $user->last_name)}}" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{old('email' , $user->email)}}">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone' , $user->phone)}}" required>
    </div>
    <div class="form-group">
        <select name="role" id="role">
            <option value="">Select A role</option>
            <option value="admin">Admin</option>
            <option value="member">Member</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$button}}</button>
