<?php

namespace App\Service;

class ResultConstructor
{
    public function imageParser($url): array
    {
        $parser = new UrlParser();
        $images = $parser->parse($url);

        $allImages = [];

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

    public function allImagesSize(array $allImages): float
    {
        $imageSizeBytes = 0;

        foreach ($allImages as $iSize) {

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

    public function allImagesCount(array $allImages): int
    {
        return count($allImages);
    }

}