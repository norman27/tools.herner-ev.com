<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Hockey\Game;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * @Route("/admin/aside")
 */
class AsideController extends Controller
{
    /**
     * @Route("/games", name="admin.aside.games", options={"expose"=true})
     * @return Response
     */
    public function getGamesTracks() {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        /** @var Game[] $games */
        $games = $repository->findBy(['state' => 1], ['gamedate' => 'ASC', 'gametime' => 'ASC'], 10);

        $serializer = new Serializer(array(new ObjectNormalizer()), array('json' => new JsonEncoder()));

        return new JsonResponse([
            'games' => $serializer->normalize($games, 'json')
        ]);
    }
}
