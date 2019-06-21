<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use AppBundle\Entity\Hockey\Game;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ScheduleDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        $repository = $doctrine->getRepository(Game::class);

        /** @var Game[] $games */
        $games = $repository->findBy([
            'catid' => $screen->config['id'],
            'state' => 1,
            'homescore' => 0,
            'awayscore' => 0
        ]);
        usort($games, function($a, $b) {
            return ($a->gamedate < $b->gamedate) ? -1 : 1;
        });
        $screen->config = array_merge($screen->config, ['games' => array_slice($games, 0, 6)]);

        return $screen;
    }
}