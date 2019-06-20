<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Route("{trailingSlash}", name="admin.index", requirements={"trailingSlash" = "[/]{0,1}"}, defaults={"trailingSlash" = "/"})
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }
}
