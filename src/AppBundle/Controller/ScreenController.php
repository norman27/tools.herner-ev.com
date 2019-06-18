<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Audio\AudioRepository;

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
        $audioRepository = new AudioRepository($this->get('cache.app'));

        return new JsonResponse([
            'audio' => $audioRepository->get(),
            'effect' => [],
            'screen' => [
                'type' => 'text',
                'data' => [
                    'title' => 'Willkommen',
                    'message' => 'in der Hannibal Arena'
                ]
            ],
            'timestamp' => time()
        ]);
    }
}
