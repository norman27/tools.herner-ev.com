<?php

namespace App\Controller\Youngsters;

use App\Youngsters\MicroSponsorsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query\QueryException;

/**
 * @Route("/youngsters")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("/microsponsors", name="youngsters.microsponsors")
     * @param MicroSponsorsRepository $repository
     * @return Response
     * @throws QueryException
     */
    public function microsponsorsAction(MicroSponsorsRepository $repository): Response
    {
        return $this->render(
            'youngsters/microsponsors.html.twig',
            [
                'sponsors' => $repository->findAllIndexed()
            ]
        );
    }
}
