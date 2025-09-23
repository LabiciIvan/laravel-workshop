<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

interface ShouldWatchInteractions {

    public function getAvailableColumn(): string;

    public function getModelName(): string;
}

class ModelInteractions implements ShouldQueue, ShouldWatchInteractions
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $collection;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }

    public function getAvailableColumn(): string {
        return 'email';
    }

    public function getModelName(): string {
        return 'users';
    }
}
