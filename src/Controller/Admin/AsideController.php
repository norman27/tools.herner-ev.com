<?php

namespace App\Controller\Admin;

use App\Entity\Hockey\Game;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * @Route("/admin/aside")
 */
class AsideController extends AbstractController
{
    /**
     * @Route("/games", name="admin.aside.games", options={"expose"=true})
     * @param ManagerRegistry $managerRegistry
     * @return Response
     * @throws ExceptionInterface
     */
    public function getGamesTracks(ManagerRegistry $managerRegistry) {
        $repository = $managerRegistry->getRepository(Game::class);
        /** @var Game[] $games */
        $games = $repository->findBy(['state' => 1], ['gamedate' => 'ASC', 'gametime' => 'ASC'], 10);

        $serializer = new Serializer(array(new ObjectNormalizer()), array('json' => new JsonEncoder()));

        return new JsonResponse([
            'games' => $serializer->normalize($games, 'json')
        ]);
    }
}
