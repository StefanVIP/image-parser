<?php

namespace App\Controller;

use App\Entity\ImageParser;
use App\Form\ImageParserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlParserController extends AbstractController
{
    #[Route('/', name: 'app_url_parser')]
    public function index(Request $request): Response
    {
        $imageParser = new ImageParser();

        $form = $this->createForm(ImageParserType::class, $imageParser);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $url = $imageParser->getUrl() ?? null;

            return $this->redirectToRoute('result_page', [
                'url' => $url
            ]);
        }

        return $this->render('url_parser/index.html.twig', [
            'form' => $form,
        ]);

    }
}
