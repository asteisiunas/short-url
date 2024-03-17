<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\UrlMap;
use App\Services\ShortUrlFiller;
use Illuminate\Console\Command;

class GenerateUrlMaps extends Command
{
    protected $signature = 'app:generate-url-maps {limit=1000}';

    protected $description = 'Command description';


    public function __construct(private readonly ShortUrlFiller $shortUrlFiller)
    {
        parent::__construct();
    }

    public function handle()
    {
        $limit = (int)$this->argument('limit');

        for ($i = 0; $i < $limit; $i++) {
            $urlMap = new UrlMap();
            $urlMap->save();

            $this->shortUrlFiller->fill($urlMap);
        }
    }
}
