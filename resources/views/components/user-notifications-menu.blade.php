    <a class="icon-text fs-6 " role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($unreadCount)
            {{-- <span class="badge bg-dark me-1">{{ $unreadCount }}</span> --}}
        @endif
        <div class="icon-text ms-3"><i class="fas fa-bell"></i></i><span
            class=""></span></div>
    </a>
    <ul class="dropdown-menu p-2">
        @foreach ($notifications as $notification)
            <li>
                <a  class="dropdown text-black" 
                    href="{{ isset($notification->data['link']) ? $notification->data['link'] . '?nid=' . $notification->id : '#' }}">
                    @if ($notification->unread())
                        <b>*</b>
                    @endif
                    @if (isset($notification->data['title']))
                        {{ $notification->data['title'] }}
                    @else
                        'reminder to your reservtion'
                    @endif
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            </li>
        @endforeach
    </ul>
