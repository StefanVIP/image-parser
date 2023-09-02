<?php

namespace App\Controller;

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
        $form = $this->createForm(ImageParserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $url = $form->getData()->getUrl();

            if (!checkdnsrr(parse_url($url)['host'])) {
                return $this->render('url_parser/index.html.twig', [
                    'form' => $form,
                    'error' => 'This page is not available'
                ]);

            } else {
                return $this->redirectToRoute('result_page', [
                    'url' => $url,
                ]);
            }

        }

        return $this->render('url_parser/index.html.twig', [
            'form' => $form,
            'error' => null
        ]);
    }
}
