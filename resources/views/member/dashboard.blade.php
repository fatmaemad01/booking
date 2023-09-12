<x-main-layout title="make a request">
    <div class="container">

                

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
        @endforeach
        </ul>
        </div>
        @endif

    
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="my-3">{{ Auth::user()->first_name }} Requests</h1>
            <x-bg-modal btn="Create a request" class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl" id="create">
                <div class="modal-body p-4">
                    <h4>Make A Request</h4>
                    <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('member.request._form' , [
                        'button_lable' => 'Create a Request'
                        ])
                    </form>
                </div>
            </x-bg-modal>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Space Name</th>
                    <th scope="col">Space Type</th>
                    <th scope="col">start_date</th>
                    <th scope="col">end_date</th>
                    <th scope="col">start_time</th>
                    <th scope="col">end_time</th>
                    <th scope="col">days</th>
                    <th scope="col">status</th>
                    <th scope="col">message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->user?->first_name }}</td>
                        <td>{{ $request->space?->name }}</td>
                        <td>{{ $request->space?->type }}</td>
                        <td> {{ $request?->start_date->format('d-m-Y')  }}</td>
                        <td>{{ $request?->end_date->format('d-m-Y') }}</td>
                        <td>{{ $request?->start_time }}</td>
                        <td>{{ $request?->end_time }}</td>
                        <td>
                            @foreach ($request->days as $day)
                                {{ $day->name }}
                                @if (!$loop->last)
                                    ,
                                @endif
                             @endforeach
                        </td>
                        <td>{{ $request?->status }}</td>
                        <td>{{ $request?->message }}</td>
                        {{-- <td>
                            <div class="">
                                <x-bg-modal btn="Edit " class="modal-dialog-centered modal-xl"
                                    id="edit{{ $request->id }}">
                                    <div class="modal-body p-4">
                                        <h4 class="text-center my-2 fw-bold">Update {{ $request->type }} Info</h4>
                                        <form action="{{ route('request.update', $request->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @include('admin.request._form', [
                                                'btn' => 'Update request',
                                            ])
                                        </form>
                                    </div>
                                </x-bg-modal>
                                <x-bg-modal btn="Delete" class="modal-dialog-centered "
                                    id="delete{{ $request->id }}">
                                    <div class="modal-body p-4 text-center">
                                        <form action="{{ route('request.destroy', $request->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <h4 class="mb-2">Are You Sure ?</h4>
                                            <h5 class="text-secondary mb-3">You Will Delete {{ $request->name }}
                                                {{ $request->type }} Forever.</h5>

                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary mx-3"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </x-bg-modal>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>