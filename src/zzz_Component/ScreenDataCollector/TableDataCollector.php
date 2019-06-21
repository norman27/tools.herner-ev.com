<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use AppBundle\Entity\Table;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TableDataCollector implements DataCollectorInterface {
    /**
     * @inheritdoc
     */
    public function collect(Registry $doctrine, Screen $screen) {
        $repository = $doctrine->getRepository(Table::class);

        /** @var Table[] $tables */
        $tables = $repository->findBy([
            'catid' => $screen->config['id'],
            'state' => 1
        ]);
        usort($tables, function($a, $b) {
            if ($a->points == $b->points) {
                return (($a->goalsFor - $a->goalsAgainst) < ($b->goalsFor - $b->goalsAgainst)) ? 1 : -1;
            }
            return ($a->points < $b->points) ? 1 : -1;
        });
        $screen->config = array_merge($screen->config, ['tables' => $tables]);

        return $screen;
    }
}