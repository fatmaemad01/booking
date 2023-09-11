<x-main-layout title="Spaces">
    {{-- @foreach ($spaces as $space)
        <h4>{{$space->name}}</h4>
        <h4>{{$space->type}}</h4>
        <h4>{{$space->branch->name}}</h4>
        <hr>
    @endforeach --}}
    <div class="container p-4">
        <h2 class="text-muted">Spaces</h2>
        <x-bg-modal btn="Open Modal" class="modal-dialog-scrollable" id="myModal">
            <h3>Test Model</h3>
        </x-bg-modal>

    </div>
</x-main-layout>
