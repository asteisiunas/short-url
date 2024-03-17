<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UrlMap;
use App\Repositories\UrlMapRepository;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUrlRequest;

class UrlController extends Controller
{
    public function __construct(private readonly UrlMapRepository $urlMapRepository)
    {
    }

    public function store(StoreUrlRequest $request): RedirectResponse|Redirector
    {
        $url = $request->validated('url');

        $urlMap = $this->urlMapRepository->findByUrl($url);

        if ($urlMap !== null) {
            return redirect()->route('short-urls.show', $urlMap->id);
        }

        $urlMap = new UrlMap(['url' => $url]);
        $urlMap->save();

        return redirect()->route('short-urls.show', $urlMap->id);
    }
}
