<?php

namespace App\Http\Controllers;

use App\Events\ArticleProcessed;
use App\Http\Controllers\Controller;
use App\Http\Decorators\ArticleContract;
use App\Http\Decorators\ArticleDecorator;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(ArticleDecorator $articleDecorator)
    {
        return $this->success(ArticleResource::collection($articleDecorator->index()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $articleId)
    {

        $article = Redis::hget('article', $articleId);

        if ($article) {
            ArticleProcessed::dispatch(json_decode($article), __METHOD__, 'From REDIS');
            return $this->success(new ArticleResource(json_decode($article)));
        }

        try {
            $article = Article::findOrFail($articleId);
        } catch (ModelNotFoundException) {
            return $this->notFound();
        }

        Redis::hset('article', $articleId, $article->toJson());

        ArticleProcessed::dispatch($article, __METHOD__, 'From DATABASE');

        return $this->success(new ArticleResource($article));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
