<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Player;
use AppBundle\Entity\Screen;
use Doctrine\Bundle\DoctrineBundle\Registry;

class PlayersDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        $repository = $doctrine->getRepository(Player::class);

        /** @var Player[] $players */
        $foundPlayers = $repository->findBy([
            'catid' => $screen->config['id'],
            'state' => 1,
            'number' => $screen->config['players']
        ]);
        $players = [];
        foreach ($foundPlayers as $player) {
            $players[$player->number] = $player;
        }
        $players = array_replace(array_flip($screen->config['players']), $players); // sorting
        $screen->config['players'] = $players;

        return $screen;
    }
}