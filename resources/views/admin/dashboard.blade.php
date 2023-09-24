<x-main-layout title="Dashboard">
    <x-secondary-nav heading="Incoming Request" />

    <x-alert class="alert alert-danger" name="error" />
    <x-alert class="alert alert-success" name="success" />

    <div class="row mb-4 m-0"
        style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="">Filter</h5>
            <div class="d-flex">
                <select class="form-control text-white" id="nameFilter" style="background-color:#6ca9be">
                    <option value="">SpaceName</option>
                    @foreach ($spaces as $space)
                        <option value="{{ $space->name }}">{{ $space->name }}</option>
                    @endforeach
                </select>
                <select class="form-control text-white ms-2" id="typeFilter" style="background-color: #6ca9be">
                    <option value="">Type</option>
                    @foreach ($uniqueTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table table-borderless" id="requestTable">
            <thead>
                <tr class="border-bottom">
                    <th scope="col">User Name</th>
                    <th scope="col">Space Name</th>
                    <th scope="col">Space Type</th>
                    <th scope="col">start_date</th>
                    <th scope="col">end_date</th>
                    <th scope="col">start_time</th>
                    <th scope="col">end_time</th>
                    <th scope="col">days</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr class="border-bottom" 
                        data-name="{{ $request->space?->name }}"
                        data-type="{{ $request->space?->type }}">
                        <td class=" py-3">{{ $request->user?->first_name }}</td>
                        <td class=" py-3">{{ $request->space?->name }}</td>
                        <td class=" py-3">{{ $request->space?->type }}</td>
                        <td class=" py-3"> {{ $request?->start_date }}</td>
                        <td class=" py-3">{{ $request?->end_date }}</td>
                        <td class=" py-3">{{ $request?->start_time }}</td>
                        <td class=" py-3">{{ $request?->end_time }}</td>
                        <td class=" py-3">
                            @foreach ($request->days as $day)
                                {{ $day }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td class="d-flex align-items-center py-3">
                            <x-bg-modal icon="fa-solid fa-check"  class="modal-dialog-centered " id="accept{{ $request->id }}">
                                <div class="modal-body p-4">
                                    <form action="{{ route('request.accept', $request->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <h4 class="mb-4 text-center">Accept a request</h4>
                                        <input type="hidden" name="space_id" value="{{ $request->space_id }}">
                                        <x-form.form-outline>
                                            <label class="form-label" for="message">Message</label>
                                            <textarea rows="5" name="message" id="message" class="form-control">{{ old('message', $request->message) }}</textarea>
                                            <x-error-message name="message" />
                                        </x-form.form-outline>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary mx-3"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">accept</button>
                                        </div>
                                    </form>
                                </div>
                            </x-bg-modal>
                            <x-bg-modal icon="fa-times  text-danger" class="modal-dialog-centered" id="deny{{ $request->id }}">
                                <div class="modal-body p-4">
                                    <form action="{{ route('request.reject', $request->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <h4 class="mb-4 text-center">Deny a request</h4>
                                        <x-form.form-outline>
                                            <label class="form-label" for="message">Message</label>
                                            <textarea rows="5" name="message" id="message" class="form-control">{{ old('message', $request->message) }}</textarea>
                                            <x-error-message name="message" />
                                        </x-form.form-outline>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary mx-3"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">deny</button>
                                        </div>
                                    </form>
                                </div>
                            </x-bg-modal>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $requests->links() }}
        </div>
    </div>
</x-main-layout>

<script>
    const nameFilter = document.getElementById('nameFilter');
    const typeFilter = document.getElementById('typeFilter');
    const requestTable = document.getElementById('requestTable');

    // Add event listeners to the filters
    nameFilter.addEventListener('change', filterTable);
    typeFilter.addEventListener('change', filterTable);

    function filterTable() {
        const selectedName = nameFilter.value;
        const selectedType = typeFilter.value;

        const rows = requestTable.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const rowName = row.getAttribute('data-name');
            const rowType = row.getAttribute('data-type');

            const nameMatch = !selectedName || rowName === selectedName;
            const typeMatch = !selectedType || rowType === selectedType;

            if (nameMatch && typeMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
