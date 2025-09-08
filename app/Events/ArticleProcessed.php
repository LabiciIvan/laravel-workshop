<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

class ArticleProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Article|stdClass|array|Collection $article;

    public $action;

    public $message = null;

    /**
     * Create a new event instance.
     */
    public function __construct(Article|stdClass|array|Collection $article, string $action, string $message = null)
    {
        $this->article = $article;

        $this->action = $action;

        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
