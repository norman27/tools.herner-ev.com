<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Screen;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\Admin\FileUploadForm;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Repository\ScreenRepository;
use AppBundle\Repository\EffectsRepository;
use AppBundle\Audio\AudioRepository;

/**
 * @Route("/admin/cronjob")
 */
class CronjobController extends Controller
{
    /**
     * @Route("{trailingSlash}", name="admin.screen.index", requirements={"trailingSlash" = "[/]{0,1}"}, defaults={"trailingSlash" = "/"})
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }
}
