<x-main-layout title="Dashboard">
    <x-secondary-nav heading="Incoming Request" />


    <x-alert class="alert alert-danger" name="error" />
    <x-alert class="alert alert-success" name="success" />

    <div class="row mb-4 m-0"
        style="border-radius: 20px; background: #fff; padding: 20px; box-shadow: 2px 3px 7px 0px #d2d2d2;">
        <table class="table table-borderless">
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
                    <tr class="border-bottom">
                        <td class=" py-4">{{ $request->user?->first_name }}</td>
                        <td class=" py-4">{{ $request->space?->name }}</td>
                        <td class=" py-4">{{ $request->space?->type }}</td>
                        <td class=" py-4"> {{ $request?->start_date }}</td>
                        <td class=" py-4">{{ $request?->end_date }}</td>
                        <td class=" py-4">{{ $request?->start_time }}</td>
                        <td class=" py-4">{{ $request?->end_time }}</td>
                        <td class=" py-4">
                            @foreach ($request->days as $day)
                                {{ $day }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td class="d-flex align-items-center py-4">
                            <x-bg-modal btn="accept" class="modal-dialog-centered " id="accept{{ $request->id }}">
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
                            <x-bg-modal btn="deny" class="modal-dialog-centered " id="deny{{ $request->id }}">
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
