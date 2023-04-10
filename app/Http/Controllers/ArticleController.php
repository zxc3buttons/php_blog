<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Article::all();
    }

    /**
     * @param string $id
     * @return Article|null
     */
    public function show(string $id): Article|null
    {
        return Article::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return Article::create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}
