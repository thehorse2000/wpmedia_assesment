<?php

namespace App\Models;

use GuzzleHttp\Exception\GuzzleException;

class Crawler
{
    protected $url;

    public function setUrl($url): static
    {
        $this->url = $url;
        return $this;
    }

    public function getAllLinks(): array
    {
        libxml_use_internal_errors(true);
        $homepageUrl = $this->url;
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->get($homepageUrl);
        $html = (string)$response->getBody();
        $domDoc = new \DOMDocument();
        $domDoc->loadHTML($html);
        $xpath = new \DOMXPath($domDoc);
        //vvv will select all <a> tags
        $allLinksNodes = $xpath->evaluate('//a');
        $allLinks = [];
        $homepageUrlFormatted = str_ends_with($homepageUrl, '/') ? $homepageUrl : $homepageUrl . '/';
        foreach ($allLinksNodes as $node) {
            $link = trim($node->attributes[0]->nodeValue);
            $allLinks[] = [
                'text' => trim($node->nodeValue),
                'link' => $link,
                'path' => $homepageUrlFormatted . $link
            ];
        }
        return $allLinks;
    }
}
