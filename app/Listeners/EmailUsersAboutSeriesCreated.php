<?php

namespace App\Listeners;

use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SeriesCreatedEvent  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        foreach (User::all() as $index => $user)
        {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seasonsQty,
                $event->episodesPerSeason,
            );

            $when = now()->addSecond($index * 2);
            Mail::to($user)->later($when, $email);
        }
    }
}
