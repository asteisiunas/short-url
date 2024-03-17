<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\SafeUrl\GoogleSafeBrowsingJudge;
use App\Services\SafeUrl\Judge;
use Illuminate\Support\ServiceProvider;
use Tests\Mocks\JudgeMock;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('production')) {
            $this->app->bind(Judge::class, GoogleSafeBrowsingJudge::class);
        } else {
            // Services what makes external calls to be mocked
            $this->app->bind(Judge::class, JudgeMock::class);
        }
    }

    public function boot(): void
    {
        //
    }
}
