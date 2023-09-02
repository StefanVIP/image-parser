<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;

class UrlParser
{
    private string $url;

    /**
     * Get HTML from URL
     * @return string
     */
    public function htmlByUrl(): string
    {
        return file_get_contents($this->url);
    }

    /**
     * Get html from URL and search all links in img tags
     * @param $url
     * @return array
     */
    public function parse($url): array
    {
        $this->url = $url;
        $crawler = new Crawler($this->htmlByUrl());
        $crawler = $crawler->filter('img')->extract(['src']);
        $images = [];
        $allImages = [];

        foreach ($crawler as $domElement) {
            $images[] = $domElement;
        }

        foreach ($images as $image) {
            if (!empty($image) && (!str_contains($image, 'data:image'))) {

                if (str_starts_with($image, '//')) {
                    $allImages[] = parse_url($url)["scheme"] . '://' . substr($image, 2);

                } elseif (!str_contains($image, 'http')) {
                    $allImages[] = parse_url($url)["scheme"] . '://' . parse_url($url)["host"] . '/' . $image;

                } else {
                    $allImages[] = $image;
                }
            }
        }
        return $allImages;
    }
}
