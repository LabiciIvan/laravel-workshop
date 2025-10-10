<?php

namespace App\Listeners;

use App\Events\ShouldWatchInteractions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class WatchInteractions implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ShouldWatchInteractions $event): void
    {
        $columnName = $event->getAvailableColumn();

        foreach ($event->collection as $model) {
            Log::info('Interaction on Model - {Identifier} was fetched', ['Identifier' => $model->$columnName]);
        }

    }
}
