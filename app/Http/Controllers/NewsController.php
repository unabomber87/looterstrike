<?php

namespace App\Http\Controllers;

use App\Models\NewsCache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Affiche les news sur la page d'accueil
     */
    public function index(Request $request): View
    {
        $limit = $request->integer('limit', 9);
        
        try {
            $articles = NewsCache::orderBy('published_at', 'desc')
                ->paginate($limit);
            
            Log::info('News cache fetched: ' . $articles->total() . ' articles');
        } catch (\Exception $e) {
            Log::error('News Cache Error: ' . $e->getMessage());
            $articles = new \Illuminate\Pagination\LengthAwarePaginator([], 0, $limit);
        }

        return view('home', ['articles' => $articles]);
    }

    /**
     * Page news dédiée avec infinite scroll
     */
    public function newsPage(Request $request): View
    {
        $limit = 9;
        
        try {
            $articles = NewsCache::orderBy('published_at', 'desc')
                ->paginate($limit);
            
            Log::info('News page loaded: ' . $articles->total() . ' articles');
        } catch (\Exception $e) {
            Log::error('News Page Error: ' . $e->getMessage());
            $articles = new \Illuminate\Pagination\LengthAwarePaginator([], 0, $limit);
        }

        return view('news', ['articles' => $articles]);
    }

    /**
     * API: Retourne les news au format JSON (pagination pour infinite scroll)
     */
    public function api(Request $request): JsonResponse
    {
        $limit = $request->integer('limit', 9);
        $page = $request->integer('page', 1);
        
        try {
            $newsItems = NewsCache::orderBy('published_at', 'desc')
                ->skip(($page - 1) * $limit)
                ->take($limit)
                ->get();
            
            $total = NewsCache::count();
            $hasMore = ($page * $limit) < $total;
            
            // Formatage pour compatibilité
            $articles = $newsItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'link' => $item->link,
                    'date' => $item->published_at->format('Y-m-d H:i'),
                    'image' => $item->image,
                    'content' => $item->excerpt,
                    'author' => $item->author,
                    'source' => $item->source,
                ];
            })->toArray();
        } catch (\Exception $e) {
            Log::error('News Cache API Error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'articles' => [],
                'hasMore' => false
            ], 500);
        }

        return response()->json([
            'articles' => $articles,
            'hasMore' => $hasMore,
            'nextPage' => $hasMore ? $page + 1 : null,
            'total' => $total
        ], 200, [
            'Cache-Control' => 'public, max-age=300',
            'X-Content-Type-Options' => 'nosniff'
        ]);
    }
}
