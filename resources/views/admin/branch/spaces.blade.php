<x-main-layout title="Spaces">

    <x-secondary-nav heading="{{ $branch->name }} Spaces" />

    <x-alert name="success" class="alert alert-success my-3" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between" style="margin-bottom:24px !important">
        <h1 class="d-flex"></h1>
        @can('create' , ['App\Models\Branch' , $branch])
            <x-bg-modal btn="New Space" icon="fa-plus" btnClass="btn-primary" class="modal-dialog modal-xl" id="create">
                <div class="modal-body p-4">
                    <h2 class="text-center my-3 fw-bold">Create New Space</h2>
                    <form action="{{ route('branch.space.store', $branch->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @include('admin.space._form', [
                            'btn' => 'Create Space',
                        ])
                    </form>
                </div>

            </x-bg-modal>
        @endcan
    </div>

    @push('styles')
        <style>
            .btn-book {
                position: relative;
                bottom: 40px;
                left: 45px;
            }
        </style>
    @endpush

    <div class="col-12">
        <div class="row mb-4"
            style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
            <div class="table-responsive">
                <table class="table table-borderless" id="requestTable">
                    <thead>
                        <tr class="border-bottom">
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Type</th>
                            <th scope="col">Capacity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spaces as $space)
                            <tr class="border-bottom" data-branch="{{ $space->branch->name }}"
                                data-type="{{ $space->type }}">
                                <th scope="row">{{ $space->id }}</th>
                                <td>{{ $space->name }}</td>
                                <td>{{ $space->branch->name }}</td>
                                <td>{{ $space->type }}</td>
                                <td>{{ $space->capacity }}</td>
                                <td>
                                    <x-bg-modal btn="Book"
                                        class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl"
                                        btnClass="btn-secondary-color" id="create{{ $space->id }}">
                                        <div class="modal-body p-4">
                                            @include('member.request._form', [
                                                'btn' => 'Book',
                                            ])
                                        </div>
                                    </x-bg-modal>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>        

    <div class="d-flex justify-content-end">
        {{ $spaces->links() }}
    </div>

</x-main-layout>
