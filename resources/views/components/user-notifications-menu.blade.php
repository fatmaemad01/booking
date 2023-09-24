<li class="nav-item dropdown">
    <a class="nav-link fs-6 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($unreadCount)
            <span class="badge bg-dark me-1">{{ $unreadCount }}</span>
        @endif
        <h5 class="text-muted"><i class="fas fa-bell"></i></h5>
    </a>
    <ul class="dropdown-menu p-2">
        @foreach ($notifications as $notification)
            <li>
                <a class="dropdown-item"
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
</li>
