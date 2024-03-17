<?php

namespace App\Services\SafeUrl;

interface Judge
{
    public function isSafe(string $url): bool;
}
