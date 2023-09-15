<?php

namespace App\Providers;

use App\Events\AcceptedRequest;
use App\Events\CreateSpace;
use App\Events\UpdateSpace;
use App\Listeners\CreateAvailability;
use App\Listeners\NewSpaceAvailability;
use App\Listeners\UpdateAvailabilty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateSpace::class => [
            CreateAvailability::class
        ],
        UpdateSpace::class => [
            UpdateAvailabilty::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
