<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Screen;
use AppBundle\Component\ScreenDataCollector\DataCollectorInterface;
use AppBundle\Repository\EffectsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Repository\ScreenRepository;

class DefaultController extends Controller {
    /**
     * @Route("/", options={"expose"=true}, name="homepage")
     */
    public function indexAction() {
        $drawScreens = [];
        $repository = $this->getScreenRepository();

        foreach ($repository->getAllForActiveCategory() as $screen) {
            $drawScreens[] = $this->collectScreenData($screen);
        }

        return $this->render('default/index.html.twig', [
            'screens' => $drawScreens
        ]);
    }

    /**
     * @Route("/refresh", options={"expose"=true}, name="refresh")
     */
    public function refreshAction() {
        $repository = $this->getScreenRepository();

        $refreshData = [
            'attendance' => [
                'attendance' => 0
            ],
            'activeScreen' => 0,
            'lastChange' => 0,
            'effect' => [
                0 => '',
                1 => '',
                'timestamp' => 0
            ],
            'livegame' => [],
            'othergames' => []
        ];

        $effects = $this->getEffectsRepository();
        if ($effects->hasEffect()) {
            $refreshData['effect'] = $effects->getEffect();
        }

        $count = 1;
        foreach ($repository->getAllForActiveCategory() as $screen) {
            $screen = $this->collectScreenData($screen);

            if ($screen->active === Screen::IS_ACTIVE) {
                $refreshData['activeScreen'] = $count;
            }

            switch ($screen->screenType) {
                case 'livegame':
                    $refreshData['livegame'] = $screen->config;
                    break;
                case 'othergames':
                    $refreshData['othergames'] = $screen->config;
                    break;
                case 'attendance':
                    $refreshData['attendance'] = $screen->config;
                    break;
            }

            $refreshData['lastChange'] = max($refreshData['lastChange'], $screen->lastChange->getTimestamp());
            $count++;
        }

        return new JsonResponse($refreshData);
    }

    /**
     * @param Screen $screen
     * @return Screen
     */
    private function collectScreenData(Screen $screen) {
        $collectorClass = '\\AppBundle\\Component\\ScreenDataCollector\\' . ucfirst($screen->screenType) . 'DataCollector';
        if (class_exists($collectorClass)) {
            /** @var DataCollectorInterface $collector */
            $collector = new $collectorClass();
            $screen = $collector->collect($this->getDoctrine(), $screen);
        }
        return $screen;
    }

    /**
     * @return ScreenRepository
     */
    private function getScreenRepository() {
        return new ScreenRepository($this->getDoctrine());
    }

    /**
     * @return EffectsRepository
     */
    private function getEffectsRepository() {
        return new EffectsRepository();
    }
}
