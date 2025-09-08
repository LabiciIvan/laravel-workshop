<?php

namespace App\Repository;

use App\Models\Article;
use App\Events\ArticleProcessed;
use Illuminate\Support\Facades\Redis;
use App\Http\Decorators\ArticleContract;

class ArticleRepository implements ArticleContract {

    /**
     * This method is commented out, and shows how the decorator would relay on
     * it's own method to pull the Articles from Redis, and if not available we
     * would call the repository method to fetch all articles and set in Redis.
     */
    // public function index()
    // {
    //     $articles = Article::all();

    //     Redis::setex('articles.all', '10', $articles->toJson());

    //     ArticleProcessed::dispatch($articles, __METHOD__, 'FROM DATABASE');

    //     return $articles;
    // }

    public function index()
    {
        $articles = Article::all();

        ArticleProcessed::dispatch($articles, __METHOD__, 'FROM DATABASE');

        return $articles;
    }

}
