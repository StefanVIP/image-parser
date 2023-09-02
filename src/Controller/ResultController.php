<?php

namespace App\Controller;

use App\Service\ResultConstructor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    private ResultConstructor $resultConstructor;

    public function __construct(ResultConstructor $resultConstructor)
    {
        $this->resultConstructor = $resultConstructor;
    }

    #[Route(path: '/result', name: 'result_page')]
    public function list(Request $request): Response
    {
        $url = $request->query->get('url');
        $result = $this->resultConstructor->construct($url);

        return $this->render('result/index.html.twig', $result);
    }
}
