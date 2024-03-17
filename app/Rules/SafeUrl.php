<?php

declare(strict_types=1);

namespace App\Rules;

use App\Services\SafeUrl\Judge;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @throws BindingResolutionException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!app()->make(Judge::class)->isSafe($value)) {
            $fail('URL is not safe');
        }
    }
}
