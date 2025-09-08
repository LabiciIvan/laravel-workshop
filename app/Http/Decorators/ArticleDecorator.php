<?php

namespace App\Http\Decorators;

use App\Events\ArticleProcessed;
use App\Repository\ArticleRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

interface ArticleContract {

    public function index();

}


class ArticleDecorator implements ArticleContract {

    protected $article;

    public function __construct(ArticleRepository $article) {
        $this->article = $article;
    }

    /**
     * First version of using Redis facade directly, however this method on
     * the article repository it's declared and commentted out, for reference only.
     */
    // public function index() {
    //     // Fetch it from Redis or get it from model itself.
    //     if ($articles = Redis::get('articles.all')) {

    //         $articles = json_decode($articles);

    //         ArticleProcessed::dispatch($articles, __METHOD__, 'FROM REDIS');

    //         return $articles;
    //     }

    //     return $this->article->index();
    // }

    public function index() {
        return Cache::remember('articles.all', 10, function () {
            return $this->article->index();
        });
    }

}
