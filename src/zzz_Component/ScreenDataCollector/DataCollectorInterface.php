<?php

namespace AppBundle\Component\ScreenDataCollector;

use AppBundle\Entity\Screen;
use Doctrine\Bundle\DoctrineBundle\Registry;

interface DataCollectorInterface {
    /**
     * @param Registry $doctrine
     * @param Screen $screen
     * @return Screen
     */
    public function collect(Registry $doctrine, Screen $screen);
}