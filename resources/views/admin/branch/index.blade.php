<x-main-layout title="Branch">

    <x-alert name="success" class="alert-success mt-4"/>
    <x-alert name="error" class="alert-danger"/>


    <div class="d-flex justify-content-between align-items-center">
        <h1 class="my-5">Branches Of Company</h1>
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
    </div>

    <section class="ftco-section bg-light" id="cards">
        <div class="container card-styles">
            <div class="row">
                @foreach($branches as $branch)
                <div class="col-md-4">
                    <div class="card">
                                <img class="card-img-top" src="{{ asset('assets/logo.png')}}" alt="">
                        <div class="card-body pb-5 px-4">
                            <h5 class="card-title text-center mb-4" style="font-weight: bold">{{ $branch->name }}</h5>
                            <p class="card-text"><span  style="font-weight: bold">Location : </span>{{ $branch->location}}</p>
                            <p class="card-text"><span  style="font-weight: bold">Work days  : </span>@foreach($branch->workDays as $day) {{ $day->name}} - @endforeach</p>
                            <p class="card-text"><span  style="font-weight: bold">Work time : </span>{{ $branch->start_time}} - {{ $branch->end_time}}</p>
                            <a href="{{ route('branch.showSpaces' , $branch->id)}}" class="btn btn-info text-center">Show Spaces</a>
                        </div>
                    </div>
                </div>  
                @endforeach
         </div>
        </div>
</section>



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