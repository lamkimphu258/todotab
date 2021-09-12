<?php

namespace App\Actions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestAction extends AbstractController
{
    #[Route('/{reactRoute}', name: 'other')]
    public function other(): Response
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
}
