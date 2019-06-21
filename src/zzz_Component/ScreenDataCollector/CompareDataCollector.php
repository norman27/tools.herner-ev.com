<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use AppBundle\Entity\Hockey\Club;
use Doctrine\Bundle\DoctrineBundle\Registry;

class CompareDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        /** @var Club[] $clubs */
        $clubs = $this->getClubs($doctrine);
        $screen->config['hometeam'] = $clubs[$screen->config['hometeam']];
        $screen->config['awayteam'] = $clubs[$screen->config['awayteam']];
        return $screen;
    }

    /**
     * @param Registry $doctrine
     * @return Club[]
     */
    private function getClubs(Registry $doctrine) { //@TODO add this to its own method copied multiple times
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