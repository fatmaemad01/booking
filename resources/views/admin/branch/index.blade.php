<x-main-layout title="Branch">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Branches Of Company</h1>
        <x-bg-modal btn="New Branch" class="modal-dialog-scrollable" id="create">
            <div class="modal-body">
                <form action="{{ route('branch.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.branch._form' , [
                        'button_lable' => 'Create'
                    ])
                </form>
            </div>
        </x-bg-modal>

    </div>
    
</x-main-layout>