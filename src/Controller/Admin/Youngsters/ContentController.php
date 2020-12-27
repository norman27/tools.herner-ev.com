<?php

namespace App\Controller\Admin\Youngsters;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/youngsters")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("/microsponsoring", name="admin.youngsters.microsponsoring", options={"expose"=true})
     * @return Response
     */
    public function microsponsoringAction()
    {
        $this->denyAccessUnlessGranted('ROLE_YOUNGSTERS');
        return new JsonResponse(1);
    }
}
