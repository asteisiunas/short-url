<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\SafeUrl;
use Illuminate\Foundation\Http\FormRequest;

class StoreUrlRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'url', new SafeUrl()],
        ];
    }
}
