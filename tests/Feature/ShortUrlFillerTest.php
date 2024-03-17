<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\UrlMap;
use App\Services\ShortUrlFiller;
use Tests\TestCase;

class ShortUrlFillerTest extends TestCase
{
    private ShortUrlFiller $shortUrlFiller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->shortUrlFiller = $this->app->make(ShortUrlFiller::class);
    }

    public function testFill(): void
    {
        $urlMap = new UrlMap();
        $urlMap->id = 1000;
        $this->shortUrlFiller->fill($urlMap);
        $this->assertSame('0000g8', $urlMap->short_url);
    }
}
