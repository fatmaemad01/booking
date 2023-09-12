<x-main-layout title="make a request">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-3">{{ Auth::user->first_name }} Requests</h1>
            <x-bg-modal btn="Create a request" class="modal-dialog-centered modal-dialog-scrollable" id="create">
                <div class="modal-body p-4">
                    <h4>Update Member Info</h4>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @include('admin.member._form' , [
                             'button_lable' => 'Update Member'
                        ])
                    </form>
                </div>
            </x-bg-modal>
        </div>
    </div>
</x-main-layout>