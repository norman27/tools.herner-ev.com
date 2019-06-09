<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ScreenController extends Controller
{
    /**
     * @Route("/screen", options={"expose"=true}, name="screen_overview")
     */
    public function indexAction()
    {
        return $this->render('screen/index.html.twig');
    }

    /**
     * @Route("/screen/api/v1/state.json", options={"expose"=true}, name="screen_api")
     */
    public function stateAction()
    {
        return new JsonResponse([
            'audio' => [
                //'src' => '/audio/the-unforgiven.mp3',
                'src' => '/audio/silence.mp3',
                'volume' => 80
            ]
        ]);
    }
}
