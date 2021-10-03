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
    public function index()
    {
        return $this->render('index/index.html.twig');
    }

    public function reactRouting()
    {
        return $this->render('index/index.html.twig');
    }
}
