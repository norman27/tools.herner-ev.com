<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use AppBundle\Entity\Club;
use Doctrine\Bundle\DoctrineBundle\Registry;

class LivegameDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        $clubs = $this->getClubs($doctrine);

        /** @var Club $home */
        $home = $clubs[$screen->config['hometeam']];

        /** @var Club $away */
        $away = $clubs[$screen->config['awayteam']];

        $screen->config['caption'] = $home->name . ' - ' . $away->name;
        $screen->config['hometeam'] = $home->logo;
        $screen->config['awayteam'] = $away->logo;

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