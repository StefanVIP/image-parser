<?php

namespace App\Service;

class ResultConstructor
{
    /**
     * Parse images links, add scheme to links then it need to, remove empty values from array
     * @param string $url
     * @return array
     */
    public function imageParser(string $url): array
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

    /**
     * Count all images size in bytes, return size in mb
     * @param array $allImages
     * @return float
     */
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

    /**
     * @param array $allImages
     * @return int
     */
    public function allImagesCount(array $allImages): int
    {
        return count($allImages);
    }

}