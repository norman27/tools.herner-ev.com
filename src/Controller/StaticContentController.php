<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StaticContentController extends AbstractController
{
    /**
     * @Route("/privacy", name="static.privacy")
     */
    public function privacyAction()
    {
        return $this->render('static/privacy.html.twig');
    }
}
