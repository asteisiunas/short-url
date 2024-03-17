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

    public function findUnused(): UrlMap
    {
        // TODO: refactor DB lock to programmatic lock using Redis
        $urlMap = UrlMap::whereNull('url')
            ->whereNotNull('short_url')
            ->limit(1)
            ->lockForUpdate()
            ->first();

        if ($urlMap === null) {
            throw new NotFoundHttpException('No short URL available');
        }

        return $urlMap;
    }
}
