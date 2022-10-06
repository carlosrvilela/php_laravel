<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Models\User;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  object  $event
     * @return void
     */
    public function handle(EventsSeriesCreated $event)
    {
        $usersList = User::all();
        foreach ($usersList as $index => $user) {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQuantity,
                $event->seriesEpisodesPerSeason
            );

            $delay = now()->addSeconds($index * 5);
            Mail::to($user)->later($delay, $email);
        }
    }
}
