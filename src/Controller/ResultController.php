<?php

namespace App\Controller;

use App\Service\ResultConstructor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    #[Route(path: '/result', name: 'result_page')]
    public function list(): Response
    {
        $resultConstructor = new ResultConstructor();

        $request = Request::createFromGlobals();
        $url = $request->query->get('url');

        $allImages = $resultConstructor->imageParser($url);
        $allImagesSize = $resultConstructor->allImagesSize($allImages);
        $allImagesCount = $resultConstructor->allImagesCount($allImages);

        return $this->render('result/index.html.twig', [
            'url' => $url,
            'imageCount' => $allImagesCount,
            'imagesSize' => $allImagesSize,
            'images' => array_chunk($allImages, 4) ?? null,
        ]);
    }
}
