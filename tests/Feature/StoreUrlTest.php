<?php

namespace Tests\Feature;

use App\Models\UrlMap;
use App\Services\SafeUrl\Judge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreUrlTest extends TestCase
{
    use RefreshDatabase;

    public function testStore(): void
    {
        $url = 'https://laravel.com';
        $this->assertNull(UrlMap::where('url', $url)->first());

        $this->post('/short-urls', ['url' => $url]);

        $this->assertEquals('000001', UrlMap::where('url', $url)->first()->short_url);
    }

    public function testStoreWithInvalidUrl()
    {
        $judgeMock = $this->createMock(Judge::class);
        $judgeMock
            ->method('isSafe')
            ->willReturn(false);

        $this->app->instance(Judge::class, $judgeMock);

        $this->post('/short-urls', ['url' => 'invalid-url'])
            ->assertSessionHasErrors('url');
    }
}
