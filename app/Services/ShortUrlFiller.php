<?php

declare(strict_types=1);

namespace App\Services;

use LogicException;
use App\Models\UrlMap;

class ShortUrlFiller
{
    public function __construct(private readonly NumberBaseConverter $numberBaseConverter)
    {
    }

    public function fill(UrlMap $urlMap): void
    {
        if ($urlMap->id === null) {
            throw new LogicException('Save UrlMap before filling short_url property');
        }

        $shortUrl = $this->numberBaseConverter->convertDecimal($urlMap->id);
        $urlMap->short_url = $this->formatUrl($shortUrl);
        $urlMap->save();
    }

    private function formatUrl(string $url): string
    {
        return sprintf(
            '%s%s',
            config('url.prefix', ''),
            str_pad($url, config('url.length', 6), '0', STR_PAD_LEFT)
        );
    }
}
