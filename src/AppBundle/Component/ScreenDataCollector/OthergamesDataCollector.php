<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use AppBundle\Entity\Club;
use Doctrine\Bundle\DoctrineBundle\Registry;

class OthergamesDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        /** @var Club[] $clubs */
        $clubs = $this->getClubs($doctrine);

        for ($i = 1; $i <= 8; $i++) {
            if (isset($screen->config['home_' . $i]) && $screen->config['home_' . $i] > 0) {
                $screen->config['home_' . $i] = $clubs[$screen->config['home_' . $i]];
            }
            if (isset($screen->config['away_' . $i]) && $screen->config['away_' . $i] > 0) {
                $screen->config['away_' . $i] = $clubs[$screen->config['away_' . $i]];
            }
        }

        return $screen;
    }

    /**
     * @param Registry $doctrine
     * @return Club[]
     */
    private function getClubs(Registry $doctrine) {
        /** @var Club[] $clubs */
        $clubs = $doctrine->getRepository(Club::class)->findBy(['state' => 1]);

        $clubChoices = [];
        foreach ($clubs as $club) {
            $clubChoices[$club->id] = $club;
        }
        ksort($clubChoices);

        return $clubChoices;
    }
}