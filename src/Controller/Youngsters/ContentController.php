<?php

namespace App\Controller\Youngsters;

use App\Youngsters\MicroSponsorsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/youngsters")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("/microsponsors", name="youngsters.microsponsors")
     * @param MicroSponsorsRepository $repository
     * @return Response
     */
    public function microsponsorsAction(MicroSponsorsRepository $repository)
    {
        return $this->render(
            'youngsters/microsponsors.html.twig',
            [
                'sponsors' => $repository->findAllIndexed()
            ]
        );
    }
}
