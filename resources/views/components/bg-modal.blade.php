@props([
    'btn' => '',
    'class' => '',
    'id' => $id,
    'icon' => '',
    'btnClass' => ''
])
<!-- Button trigger modal -->
<button type="button" class="btn {{$btnClass}}" data-toggle="modal" data-target="#{{ $id }}">
    @if ($icon)
        <i class="fas {{ $icon }}"></i> <!-- Use the Font Awesome icon -->
    @endif
    {{ $btn }}
</button>

<!-- Modal -->
<div  class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $class }}">
        <div class="modal-content" >
            {{ $slot }}
        </div>
    </div>
</div>
