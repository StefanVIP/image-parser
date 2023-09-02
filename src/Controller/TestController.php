<?php

namespace App\Controller;

use App\Form\ImageParserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/testPage', name: 'app_url_test_page')]
    public function index(Request $request): Response
    {
        $images = [[
            '/images/image1.png',
            '/images/image2.png',
            '/images/image3.png'
        ]];

        return $this->render('test/index.html.twig', [
            'images' => $images
        ]);
    }
}
