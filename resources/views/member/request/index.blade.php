<x-main-layout title="make a request">

    <x-alert class="alert alsert-success" name="success" />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="my-3">{{ Auth::user()->first_name }} Requests</h1>
    </div>

    <table class="table table-borderless table-hover shadow-lg rounded">
        <thead>
            <tr class="border-bottom">
                <th scope="col">#</th>
                <th scope="col">Space Name</th>
                <th scope="col">Date</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">day</th>
                <th scope="col">status</th>
                <th scope="col">message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr class="border-bottom">
                    <td class="py-4">{{ $request->id }}</td>
                    <td class="py-4">{{ $request->space->name }}</td>
                    <td class="py-4"> {{ $request->start_date }}</td>
                    <td class="py-4">{{ $request?->start_time }}</td>
                    <td class="py-4">{{ $request?->end_time }}</td>
                    <td class="py-4">
                        @foreach ($request->days as $day)
                            {{ $day }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td class="py-4">{{ $request?->status }}</td>
                    <td class="py-4">{{ $request?->message }}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main-layout>
