<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use App\Models\UrlMap;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUrlRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UrlController extends Controller
{
    public function store(StoreUrlRequest $request): RedirectResponse|Redirector
    {
        $url = $request->validated('url');

        DB::beginTransaction();

        try {
            $urlMap = UrlMap::whereNull('url')->lockForUpdate()->first();

            if ($urlMap === null) {
                throw new NotFoundHttpException('No short URL available');
            }
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
