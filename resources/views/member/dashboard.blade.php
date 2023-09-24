<x-main-layout title="member dashboard">
    <x-secondary-nav heading="All Spaces" />

    <x-alert name="success" class="alert alert-success my-4" />

    <div class="col-12">
        <div class="row mb-4"
            style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="">Filter</h5>
                <div class="d-flex">
                    <select class="form-control text-white" id="nameFilter" style="background-color:#6ca9be">
                        <option value="">Name</option>
                        @foreach ($spaces as $space)
                            <option value="{{ $space->name }}">{{ $space->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-control text-white ms-2" id="branchFilter" style="background-color:#6ca9be">
                        <option value="">Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->name }}">{{ $branch->name }}</option>
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
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Type</th>
                        <th scope="col">Capacity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spaces as $space)
                        <tr class="border-bottom"
                            data-name="{{ $space->name }}"
                            data-branch="{{ $space->branch->name }}"
                            data-type="{{ $space->type }}">
                            <th scope="row">{{ $space->id }}</th>
                            <td>{{ $space->name }}</td>
                            <td>{{ $space->branch->name }}</td>
                            <td>{{ $space->type }}</td>
                            <td>{{ $space->capacity }}</td>
                            <td>
                                @if (Auth::user()->role == 'member')
                                    <x-bg-modal btn="Book"
                                        class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl"
                                        btnClass="btn-secondary-color"
                                        id="create{{ $space->id }}">
                                        <div class="modal-body p-4">
                                            @include('member.request._form', [
                                                'btn' => 'Book',
                                            ])
                                        </div>
                                    </x-bg-modal>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-end">
                {{ $spaces->links() }}
            </div>
        </div>
    </div>

    <script>
        const nameFilter = document.getElementById('nameFilter');
        const branchFilter = document.getElementById('branchFilter');
        const typeFilter = document.getElementById('typeFilter');
        const requestTable = document.getElementById('requestTable');
    
        // Add event listeners to the filters
        nameFilter.addEventListener('change', filterTable);
        branchFilter.addEventListener('change', filterTable);
        typeFilter.addEventListener('change', filterTable);
    
        function filterTable() {
            const selectedName = nameFilter.value;
            const selectedBranch = branchFilter.value;
            const selectedType = typeFilter.value;
    
            const rows = requestTable.querySelectorAll('tbody tr');
    
            rows.forEach(row => {
                const rowName = row.getAttribute('data-name');
                const rowBranch = row.getAttribute('data-branch');
                const rowType = row.getAttribute('data-type');
    
                const nameMatch = !selectedName || rowName === selectedName;
                const branchMatch = !selectedBranch || rowBranch === selectedBranch;
                const typeMatch = !selectedType || rowType === selectedType;
    
                if (nameMatch && branchMatch && typeMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
    
    
</x-main-layout>
