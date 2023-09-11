@props([
    'btn' => $btn , 'class' => '', 'id' => $id
])
<!-- Button trigger modal -->
<button type="button" class="btn btn-get-started" data-toggle="modal" data-target="#{{$id}}">
    {{$btn}}
  </button>

  <!-- Modal -->
  <div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog {{$class}}">
      <div class="modal-content">
        {{$slot}}
      </div>
    </div>
  </div>
