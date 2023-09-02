<?php

namespace App\Service;

class ResultConstructor
{
    private UrlParser $parser;

    public function __construct(UrlParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Count all images size in bytes, return size in mb
     * @param array $images
     * @return float
     */
    public function calculateSize(array $images): float
    {
        $imageSizeBytes = 0;

        foreach ($images as $iSize) {

            $imageSize = get_headers($iSize, 1)["content-length"] ?? get_headers($iSize, 1)["Content-Length"];

            if (is_array($imageSize)) {
                foreach ($imageSize as $size) {
                    $imageSizeBytes += $size;
                }

            } else {
                $imageSizeBytes += $imageSize;
            }
        }
        return round(($imageSizeBytes / 1024 / 1024), 2);
    }

    /**
     * Make array with all needed result data
     * @param string $url
     * @return array
     */
    public function construct(string $url): array
    {
        $images = $this->parser->parse($url);
        $size = $this->calculateSize($images);

        return [
            'url' => $url,
            'imageCount' => count($images),
            'imagesSize' => $size,
            'images' => array_chunk($images, 4),
        ];
    }
}