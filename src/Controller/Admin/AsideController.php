<?php

namespace App\Controller\Admin;

use App\Entity\Hockey\Game;
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
     * @return Response
     * @throws ExceptionInterface
     */
    public function getGamesTracks() {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        /** @var Game[] $games */
        $games = $this->getDoctrine()
            ->getManager()
            ->createQuery('SELECT g FROM App:Hockey\Game g WHERE CONCAT(g.gamedate, \' \', g.gametime) > CONCAT(CURRENT_DATE(), \' \', CURRENT_TIME()) AND g.state = 1 ORDER BY CONCAT(g.gamedate, \' \', g.gametime) ASC')
            ->setMaxResults(10)
            ->getResult();

        $serializer = new Serializer(array(new ObjectNormalizer()), array('json' => new JsonEncoder()));

        return new JsonResponse([
            'games' => $serializer->normalize($games, 'json')
        ]);
    }
}
