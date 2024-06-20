<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Release;
use App\Services\IbgeService;

class NewsReleasesController extends Controller
{
    public function getNewsAndReleases(IbgeService $ibge)
    {
        return response()->json($ibge->getNewsAndReleases());
    }

    public function getNews(IbgeService $ibge)
    {
        $news = $ibge->getNews();

        News::insert($news);

        return response()->json($news);
    }

    public function getReleases(IbgeService $ibge)
    {
        $releases = $ibge->getReleases();

        Release::insert($releases);

        return response()->json($releases);
    }
}
