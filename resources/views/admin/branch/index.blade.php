<x-main-layout title="Branch">

    <x-alert name="success" class="alert-success mt-4"/>
    <x-alert name="error" class="alert-danger"/>


    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Branches Of Company</h1>
        <x-bg-modal btn="New Branch" class="modal-dialog-scrollable" id="create">
            <div class="modal-body">
                <form action="{{ route('branch.store')}}" method="POST">
                    @csrf
                    @include('admin.branch._form' , [
                        'button_lable' => 'Create'
                    ])
                </form>
            </div>
        </x-bg-modal>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Work Days</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
                <tr>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->location }}</td>
                    <td>
                        @foreach ($branch->workDays as $day)
                            {{ $day->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                         @endforeach
                    </td>
                    <td>
                        <a href="{{ route('branch.show' , $branch->id)}}">show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</x-main-layout>