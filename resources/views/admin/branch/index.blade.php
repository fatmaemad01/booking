<x-main-layout title="Branch">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Branches Of Company</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Create A Branch
        </button>
    </div>
    
    <form action="" method="post">
        @include('admin.branch._form' , [
            'button_lable' => 'Create'
    ])
    </form>
</x-main-layout>