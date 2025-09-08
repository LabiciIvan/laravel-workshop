<?php

namespace App\Listeners;

use App\Events\ArticleProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ArticleLogs
{
    /**
     * Handle the event.
     */
    public function handle(ArticleProcessed $event): void
    {
        Log::info('Article processed, method called : {ACTION} : {ARTICLE}', ['ACTION' => $event->action, 'ARTICLE' => $event->article]);

        if ($event->message) {
            Log::alert('A custom message was provided: {MESSAGE}.', ['MESSAGE' => $event->message]);
        }
    }
}
