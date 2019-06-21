<?php

namespace AppBundle\Controller;

use AppBundle\Screen\Effect\EffectsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Screen\Audio\AudioRepository;

class ScreenController extends Controller
{
    /**
     * @Route("/screen", name="screen.index")
     */
    public function indexAction()
    {
        return $this->render('screen/index.html.twig');
    }

    /**
     * @Route("/screen/frame", name="screen.frame")
     */
    public function frameAction()
    {
        return $this->render('screen/frame.html.twig');
    }

    /**
     * @Route("/screen/api/v1/state.json", options={"expose"=true}, name="screen_api")
     * @param AudioRepository $audioRepository
     * @param EffectsRepository $effectsRepository
     * @return JsonResponse
     */
    public function stateAction(AudioRepository $audioRepository, EffectsRepository $effectsRepository)
    {
        return new JsonResponse([
            'audio' => $audioRepository->get(),
            'effect' => $effectsRepository->get(),
            'screen' => [
                // @TODO implement this
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
