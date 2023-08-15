<?php

namespace App\Http\Controllers;

use App\Models\Crawler;
use App\Models\CrawlStorage;
use App\Models\XMLWriter;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use mysql_xdevapi\Exception;
use Illuminate\Http\RedirectResponse;

class CrawlController extends Controller
{
    const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    const STORAGE_LOCATION = 'app/public/sitemap.xml';

    public function __construct(
        protected XMLWriter    $XMLWriter,
        protected CrawlStorage $crawlStorage,
        protected Crawler      $crawler
    )
    {
    }

    public function startCrawling(Request $request): ?RedirectResponse
    {
        $validated = $request->validate([
            'homepage_url' => 'bail|required|url:http,https'
        ]);
        if (!$validated) return null;
        try {
            $homepageUrl = $request->input('homepage_url');
            //vvv Crawl the url for all <a>tags
            $allLinks = $this->crawler->setUrl($homepageUrl)->getAllLinks();
            //vvv create sitemap.xml (storage/app/public/sitemap.xml) file from the results
            $this->XMLWriter->write($allLinks);
            //vvv save the results in (storage/app/results.json) instead of DB
            $result = $this->crawlStorage->storeResults($homepageUrl, $allLinks);

            return redirect()->route('admin')->with('success', true)->with('result', $result);

        } catch (Exception $err) {
            return redirect()->route('admin')->with('error', $err->getMessage());
        } catch (GuzzleException $err) {
            return redirect()->route('admin')->with('error', $err->getMessage());
        }

    }

    public function viewAllResults(): View
    {
        $results = $this->crawlStorage->getAllResults();
        return view('results', ['results' => $results]);
    }

    public function viewSingleResult(Request $request)
    {
        $homepageUrl = $request->query('homepage_url');
        $result = $this->crawlStorage->getSingleResult($homepageUrl);
        return view('single-result', ['result' => $result]);
    }
}
