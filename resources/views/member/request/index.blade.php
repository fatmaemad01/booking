<x-main-layout title="make a request">

    <x-secondary-nav heading="{{ Auth::user()->first_name }} Requests" />

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

   
    <div class="row mb-4 m-0"
        style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="">Filter</h5>
            <div class="row">
                <select class="form-control text-white" id="statusFilter" style="background-color:#6ca9be">
                    <option value="">All</option>
                    @foreach ($status as $statusType)
                    <option value="{{$statusType}}">{{$statusType}}</option> 
                    @endforeach
                </select> 
            </div>
        </div>
        <table class="table table-borderless" id="requestTable">

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
                <tr class="border-bottom" data-status="{{ $request->status }}">
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
        <div class="d-flex justify-content-end">
            {{ $requests->links() }}
        </div>
    </div>

    <script>
        const statusFilter = document.getElementById('statusFilter');
        const requestTable = document.getElementById('requestTable');
      
        statusFilter.addEventListener('change', function () {
            const selectedStatus = statusFilter.value;
            const rows = requestTable.querySelectorAll('tbody tr');
      
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (!selectedStatus || rowStatus === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
      </script>
      

</x-main-layout>

