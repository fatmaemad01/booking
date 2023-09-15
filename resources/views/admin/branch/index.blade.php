<x-main-layout title="Branch">

    <x-alert name="success" class="alert-success mt-4"/>
    <x-alert name="error" class="alert-danger"/>


    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-4">Branches Of Company</h1>

        @if(Auth::user()->role == 'admin')
        <x-bg-modal btn="New Branch" class="modal-dialog modal-xl" id="create">
            <div class="modal-body">
                <form action="{{ route('branch.store')}}" method="POST">
                    @csrf
                    @include('admin.branch._form' , [
                        'button_lable' => 'Create'
                    ])
                </form>
            </div>
        </x-bg-modal>
        @endif
    </div>

    <div class="container">
            <div class="row">
                @foreach($branches as $branch)
                <div class="col-md-4">
                    <div class="card" style="max-width: 20rem;">
                                <img class="card-img-top" src="{{ asset('assets/img/gsg2.jpg')}}" alt="" width="100" height="150">
                        <div class="card-body py-4 px-4">
                            <h4 class="card-title text-center mb-4" style="font-weight: bold">{{ $branch->name }}</h4>
                            <p class="card-text"><span  style="font-weight: bold">Location : </span>{{ $branch->location}}</p>
                            <p class="card-text"><span  style="font-weight: bold">Work days  : </span>from {{$branch->workDays->first()->name}} to {{$branch->workDays->last()->name}}</p>
                            <p class="card-text"><span  style="font-weight: bold">Work time : </span>{{ $branch->start_time}} - {{ $branch->end_time}}</p>
                            <div class="text-center">
                            <a href="{{ route('branch.showSpaces' , $branch->id)}}" class="btn btn-primary w-75">Show Spaces</a>
                            </div>
                        </div>
                    </div>
                </div>  
                @endforeach
         </div>
        </div>


    {{-- <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Work Days</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th></th>
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
                    <td>{{ $branch->start_time }}</td>
                    <td>{{ $branch->end_time }}</td>

                    <td>
                        <a href="{{ route('branch.show' , $branch->id)}}">show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    
</x-main-layout>