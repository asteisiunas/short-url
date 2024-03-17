<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property null|int $id
 * @property null|string $short_url
 * @property null|string $url
 * @method static where(string $key, string $value)
 */
class UrlMap extends Model
{
    protected $fillable = [
        'url',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(function (UrlMap $urlMap) {
            $urlMap->short_url = static::generateShortUrl($urlMap->id);
            $urlMap->save();
        });
    }

    protected static function generateShortUrl(int $id): string
    {
        return str_pad(
            base_convert((string)$id, 10, 36),
            config('url.length', 6),
            '0',
            STR_PAD_LEFT
        );
    }
}
