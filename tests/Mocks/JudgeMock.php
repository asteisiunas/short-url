<?php

namespace Tests\Mocks;

use App\Services\SafeUrl\Judge;

class JudgeMock implements Judge
{
    public function isSafe(string $url): bool
    {
        return true;
    }
}
