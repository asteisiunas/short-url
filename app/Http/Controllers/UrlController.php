<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\UrlMapRepository;
use Exception;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        DB::beginTransaction();

        try {
            $urlMap = $this->urlMapRepository->findUnused();
        } catch (Exception $exception) {
            return $this->handleException($exception, 'We are running out of short URLs !');
        }

        $urlMap->url = $url;
        $urlMap->save();

        try {
            DB::commit();
        } catch (Exception $exception) {
            return $this->handleException($exception, 'Something went wrong!');
        }

        return redirect()->route('short-urls.show', $urlMap->id);
    }

    private function handleException(Exception $exception, string $error): RedirectResponse|Redirector
    {
        DB::rollBack();

        Log::error('failed_to_store_url', ['error' => $exception->getMessage()]);

        return redirect()->route('short-urls.create')->with('error', $error);
    }
}
