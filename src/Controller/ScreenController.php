<?php

namespace App\Controller;

use App\Screen\Effect\EffectsRepository;
use App\Screen\ScreensRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Screen\Audio\AudioRepository;
use Psr\Cache\InvalidArgumentException;

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
     * @Route("/screen/state.json", options={"expose"=true}, name="screen_api")
     * @param AudioRepository $audioRepository
     * @param EffectsRepository $effectsRepository
     * @param ScreensRepository $screensRepository
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function stateAction(AudioRepository $audioRepository, EffectsRepository $effectsRepository, ScreensRepository $screensRepository)
    {
        return new JsonResponse([
            'audio' => $audioRepository->get(),
            'effect' => $effectsRepository->get(),
            'screen' => $screensRepository->getActive(),
            'timestamp' => time()
        ]);
    }
}
