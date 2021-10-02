<?php

namespace App\Actions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @codeCoverageIgnore
 * // TODO: test later
 */
class GeneralAction extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index()
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/{reactRouting}', name: 'app_react_routing')]
    public function reactRouting()
    {
        return $this->render('index/index.html.twig');
    }
}
