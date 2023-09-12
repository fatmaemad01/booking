<x-main-layout title="Dashboard">
{{-- <x-nav/> --}}
    <div class="container p-4">
        <h2 class="text-muted my-4">Incoming Requests</h2>
        {{-- <x-bg-modal btn="Open Modal" class="modal-dialog-scrollable" id="myModal">
            <h3>Test Model</h3>
        </x-bg-modal> --}}

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
                    <th scope="col"></th>
                    <th scope="col"></th>
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

                        <td>
                            <x-bg-modal btn="accept" class="modal-dialog-centered " id="accept{{$request->id}}">
                                <div class="modal-body p-4">
                                    <form action="{{--{{ route('request.accept' , $request->id)}}--}}" method="post">
                                        @csrf
                                        @method('put')
                                        <h4 class="mb-4 text-center">Accept a request</h4>
                                        <x-form.form-outline>
                                            <label class="form-label" for="message">Message</label>
                                            <textarea rows="5" name="message" id="message" class="form-control">{{ old('message', $request->message) }}</textarea>
                                            <x-error-message name="message" />
                                        </x-form.form-outline>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary mx-3" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">accept</button>
                                        </div>   
                                    </form>
                                </div>
                            </x-bg-modal>
                        </td>
                        <td>
                            
                            <x-bg-modal btn="deny" class="modal-dialog-centered " id="dent{{$request->id}}">
                                <div class="modal-body p-4">
                                    <form action="{{--{{ route('request.deny' , $request->id)}}--}}" method="post">
                                        @csrf
                                        @method('put')
                                        <h4 class="mb-4 text-center">Deny a request</h4>
                                        <x-form.form-outline>
                                            <label class="form-label" for="message">Message</label>
                                            <textarea rows="5" name="message" id="message" class="form-control">{{ old('message', $request->message) }}</textarea>
                                            <x-error-message name="message" />
                                        </x-form.form-outline>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary mx-3" data-dismiss="modal">Close</button>
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
    </div>
</x-main-layout>
