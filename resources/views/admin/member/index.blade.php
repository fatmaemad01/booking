<x-main-layout title="Members">
        <div class="d-flex justify-content-between mb-4">
            <h2 class="text-muted">Members</h2>
            <x-bg-modal btn="New Member"  icon="fa-plus" btnClass="btn-primary" class="modal-dialog-centered modal-xl" id="create">
                <div class="modal-body p-4">
                    <h4 class="text-center fw-bold mb-3 mt-3">{{ __('Add New Member ') }}</h4>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        @include('admin.member._form', [
                            'button_lable' => 'Add Member',
                        ])
                        <div class="row" style="display: none">
                            <div class="col-md-6">
                                <x-form.form-outline>
                                    <label class="form-label" for="password">password</label>
                                    <x-form.input name="password" id="password" type="password" value="{{Str::random(12)}}"
                                        required autofocus autocomplete="new-password" />
                                    {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                                </x-form.form-outline>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <button type="submit" class="btn btn-primary" style="width: 20%">
                                Create
                            </button>
                            <button type="button" class="btn btn-get-started  mx-3"
                                data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
         </x-bg-modal>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <table class="table table-borderless table-hover shadow-lg rounded">
            <thead>
                <tr class="border-bottom">
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-bottom">
                    <td class="py-2">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="py-2">{{ $user->phone }}</td>
                    <td class="py-2"> {{ $user->email }}</td>
                    <td class="py-2">{{ $user->role }}</td>
                    <td class="py-2">
                        <div class="">
                            <x-bg-modal icon="fa-edit text-muted" class="me-5 modal-dialog-centered modal-xl"
                            id="update{{ $user->id }}">
                            <div class="modal-body p-4">
                                <h4 class="text-center my-3 fw-bold">Update Member Info</h4>
                                <form action="{{ route('users.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @include('admin.member._form')
                                    <div class="d-flex justify-content-center my-3">
                                        <button type="submit" class="btn btn-primary" style="width: 20%">
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-get-started  mx-3"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </x-bg-modal>
                        <x-bg-modal icon="fa-trash text-muted" class="modal-dialog-centered"
                            id="delete{{ $user->id }}">
                            <div class="modal-body p-4">
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <h4 class="mb-2 text-center">Are You Sure ?</h4>
                                    <h5 class="text-secondary text-center mb-3">You Will Delete
                                        {{ $user->first_name }} {{ $user->last_name }}
                                        Forever.</h5>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success me-4 ">
                                            <i class="fas fa-check fs-4"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger " data-dismiss="modal"><i
                                                class="fas fa-times fs-4"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </x-bg-modal>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

</x-main-layout>


