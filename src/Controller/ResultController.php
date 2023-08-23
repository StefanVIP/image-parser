<?php

namespace App\Controller;

use App\Service\UrlParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    private UrlParser $parser;

    public function __construct(UrlParser $parser)
    {
        $this->parser = $parser;
    }

    #[Route(path: '/result', name: 'result_page')]
    public function list(): Response
    {
        $url = $_GET['url'];
        $images = $this->parser->parse($url);
        $allImages = [];
        $imageSizeBytes = 0;

        foreach ($images as $image) {
            if (!empty($image) && (!str_contains($image, 'data:image'))) {
                if (!str_contains($image, 'http')) {
                    $allImages[] = parse_url($url)["scheme"] . '://' . parse_url($url)["host"] . '/' . $image;
                } else {
                    $allImages[] = $image;
                }
            }
        }

        foreach ($allImages as $iSize) {
            $imageSizeBytes += (get_headers($iSize, 1)["Content-Length"]);
        }

        $imageSizeMb = round(($imageSizeBytes / 1024 / 1024), 2);
        $imageCount = count($allImages);

        return $this->render('result/index.html.twig', [
            'images' => array_chunk($allImages, 4) ?? null,
            'imagesSize' => $imageSizeMb,
            'imageCount' => $imageCount
        ]);
    }
}
