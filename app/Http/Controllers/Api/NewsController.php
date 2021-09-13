<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

class NewsController extends Controller
{


    function getByCategoryName(Request $request)
    {
        $id = $request->input('category_id');
        $news = News::where([
            ['category_id', $id]
        ])->get();

        $filterKey = $request->get('keyword');
        $key = News::all();

        if ($filterKey) {
            $key = News::where('title', 'LIKE', "%$filterKey%")->get();
        }

        if ($news->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                // 'reply' => 'Berita tidak ditemukan dengan kategori tersebut',
                // 'totalNews' => News::count(),
                'totalResults' => $news->count(),
                'articles' => NewsResource::collection($news)

            ], 200);
        } else {
            return response()->json([
                'status' => 'ok',
                // 'reply' => 'List ditemmukan',
                // 'totalNews' => News::count(),
                'totalResults' => $news->count(),
                'articles' => NewsResource::collection($news)
            ], 200);
        }
    }
}
