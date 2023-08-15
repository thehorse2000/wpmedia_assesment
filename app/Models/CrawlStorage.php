<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class CrawlStorage
{
    const FILE_NAME = 'results.json';

    public function getAllResults()
    {
        return json_decode(Storage::disk('local')->get(self::FILE_NAME));
    }

    public function getSingleResult($homepageUrl): ?array
    {
        $allResults = json_decode(Storage::disk('local')->get(self::FILE_NAME));
        $filteredResultIndex = array_search($homepageUrl, array_column($allResults, 'homepage_url'));
        if (is_numeric($filteredResultIndex)) {
            $result = $allResults[$filteredResultIndex] ?? null;
            return json_decode(json_encode($result), true);
        } else return null;
    }

    public function storeResults($homepageUrl, $allLinks): array
    {
        $date = $this->getLastModifiedDate();
        $results = [
            "homepage_url" => $homepageUrl,
            "date" => $date,
            "results" => $allLinks
        ];
        $oldResults = $this->getAllResults();
        $previousResultIndex = array_search($homepageUrl, array_column($oldResults ?? [], 'homepage_url'));
        if (is_numeric($previousResultIndex)) {
            $oldResults[$previousResultIndex] = $results;
        } else {
            $oldResults[] = $results;
        }
        Storage::disk('local')->put('results.json', json_encode($oldResults));
        return $results;
    }

    private function getLastModifiedDate(): string
    {
        $timestamp = time();
        return gmdate('c', $timestamp);

    }
}
