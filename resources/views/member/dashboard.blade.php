<x-main-layout title="member dashboard">

    <x-alert name="success" class="alert alert-success my-4" />

    <div class="col-12">
        <div class="row mb-4">
            <div class="col-8 ps-0">
                <div
                    style="border-radius: 20px;background: #fff;height: 150px;padding: 20px;box-shadow: 2px 3px 7px 0px #d2d2d2;">
                    <h5 class="mb-4">Quick Search</h5>
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" class="form-control" style="padding: 23px"
                                    placeholder="Search for a space...">
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <button class="btn bg-primary-color text-white py-2" style="width: 100%">Filter
                                By</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4"
                style="color: white;border-radius: 20px;background: #6ca9be;height: 150px;padding: 20px;box-shadow: 2px 3px 7px 0px #d2d2d2;">
                <h3 class="mb-4">100</h3>
                <p>Spaces was booked in 30 days</p>
            </div>
        </div>
        <div class="row mb-4"
            style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
            <h5 class="mb-4">All Spaces</h5>
            <table class="table table-borderless">
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
                        <tr class="border-bottom">
                            <th scope="row">{{ $space->id }}</th>
                            <td>{{ $space->name }}</td>
                            <td>{{ $space->branch->name }}</td>
                            <td>{{ $space->type }}</td>
                            <td>{{ $space->capacity }}</td>
                            <td>
                                @if (Auth::user()->role == 'member')
                                    <x-bg-modal btn="Book"
                                        class="modal-dialog-centered modal-dialog-scrollable modal-dialog modal-xl"
                                        id="create{{ $space->id }}">
                                        <div class="modal-body p-4">
                                            @include('member.request._form', [
                                                'btn' => 'Book',
                                            ])
                                            </form>
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

</x-main-layout>
