<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;

class UrlParser
{
    public function parse($url): array
    {

        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('img')->extract(['src']);
        $images = [];

        foreach ($crawler as $domElement) {
            $images[] = $domElement;
        }

        return $images;
    }
}
