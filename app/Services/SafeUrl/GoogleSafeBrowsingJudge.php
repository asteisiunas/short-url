<?php

namespace App\Services\SafeUrl;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GoogleSafeBrowsingJudge implements Judge
{
    public function isSafe(string $url): bool
    {
        $apiEndpoint = sprintf(
            'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=%s',
            config('url.judges.google.api_key', '')
        );

        try {
            $response = Http::post($apiEndpoint, [
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [['url' => $url]],
                ],
            ]);

            $result = $response->json();
        } catch (Exception $exception) {
            Log::error('failed_to_judge_url', ['error' => $exception->getMessage()]);

            return true; // assume it's safe. I didn't even bother to get a Google Safe Browsing API key :)
        }

        return empty($result['matches']);
    }
}
