<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cronjob")
 */
class CronjobController extends AbstractController
{
    /**
     * @Route("", name="admin.screen.index")
     * @return Response
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('ROLE_TECH');
        return $this->render('admin/index.html.twig');
    }
}
