<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property null|int $id
 * @property null|string $short_url
 * @property null|string $url
 * @method static whereNull(string $string)
 * @method static where(string $key, string $value)
 */
class UrlMap extends Model
{
}
