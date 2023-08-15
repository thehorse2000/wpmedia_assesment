<?php

namespace App\Models;


use Symfony\Component\HttpFoundation\BinaryFileResponse;

class XMLWriter
{
    const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
    const STORAGE_LOCATION = 'app/public/sitemap.xml';

    public function __construct(protected \XMLWriter $XMLWriter)
    {
    }

    public function download(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download(storage_path(self::STORAGE_LOCATION), 'sitemap.xml');
    }

    public function write($allLinks): void
    {
        $this->XMLWriter->openURI(storage_path(self::STORAGE_LOCATION));
        $this->XMLWriter->startDocument('1.0', 'UTF-8');
        $this->XMLWriter->setIndent(true);
        $this->XMLWriter->startElement('urlset');
        $this->XMLWriter->writeAttribute('xmlns', self::SCHEMA);
        $highestLinkParts = 0;
        foreach ($allLinks as $link) {
            $linkParts = explode('/', $link['link']);
            if (count($linkParts) > $highestLinkParts) {
                $highestLinkParts = count($linkParts);
            }
            $this->XMLWriter->startElement('url');
            $this->XMLWriter->writeElement('loc', $link['path']);
            $this->XMLWriter->writeElement('lastmod', $this->getLastModifiedDate());
            $this->XMLWriter->writeElement('priority', $this->getPriorityLevel($link['link'], $highestLinkParts));
            $this->XMLWriter->endElement();
        }
        $this->XMLWriter->endElement();
        $this->XMLWriter->endDocument();
    }

    private function getPriorityLevel($link, $highestParts): string
    {
        $linkParts = substr_count($link, '/');
        return 1 - ($linkParts / $highestParts);
    }

    private function getLastModifiedDate(): string
    {
        $timestamp = time();
        return gmdate('c', $timestamp);

    }
}
