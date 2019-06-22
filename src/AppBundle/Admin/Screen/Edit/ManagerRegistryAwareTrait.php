<?php

namespace AppBundle\Admin\Screen\Edit;

use Doctrine\Common\Persistence\ManagerRegistry;

trait ManagerRegistryAwareTrait
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }
}