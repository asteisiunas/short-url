<?php

namespace App\Repositories;

use App\Models\UrlMap;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UrlMapRepository
{
    public function findByUrl(string $url): ?UrlMap
    {
        return UrlMap::where('url', $url)->first();
    }
}
