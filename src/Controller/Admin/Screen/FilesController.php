<?php

namespace App\Controller\Admin\Screen;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use App\Admin\Screen\FileUploadForm;
use App\Screen\FilesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/screen/files")
 * @Security("has_role('ROLE_SCREEN')")
 */
class FilesController extends AbstractController
{
    /**
     * @Route("", name="admin.screen.files")
     * @param Request $request
     * @param FilesRepository $repository
     * @return Response
     */
    public function filesAction(Request $request, FilesRepository $repository)
    {
        $form = $this->createForm(FileUploadForm::class);
        $form->handleRequest($request); // @TODO move upload to its own action

        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $file */
            $file = $form->getData()['file'];
            $repository->upload($file);
            return $this->redirect($this->generateUrl('admin.screen.files'));
        }

        return $this->render('admin/screen/files.html.twig', [
            'files' => $repository->getAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{filename}", name="admin.screen.files.delete", requirements={"filename" = "[a-z0-9._-]+"})
     * @param string $filename
     * @param FilesRepository $repository
     * @return Response
     */
    public function filesDeleteAction($filename, FilesRepository $repository)
    {
        $repository->delete($filename);
        return $this->redirect($this->generateUrl('admin.screen.files'));
    }
}
