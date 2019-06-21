<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Screen\Audio\AudioRepository;
use AppBundle\Admin\Form\FileUploadForm;
use AppBundle\Entity\Screen;
use AppBundle\Screen\Effect\EffectsRepository;
use AppBundle\Screen\FilesRepository;
use AppBundle\Screen\ScreensRepository;

/**
 * @Route("/admin/screen")
 */
class ScreenController extends Controller
{
    /**
     * @Route("/files", name="admin.screen.files")
     * @param Request $request
     * @param FilesRepository $repository
     * @return Response
     */
    public function filesAction(Request $request, FilesRepository $repository)
    {
        $form = $this->createForm(FileUploadForm::class);
        $form->handleRequest($request);

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
     * @Route("/files/delete/{filename}", name="admin.screen.files.delete", requirements={"filename" = "[a-z0-9._-]+"})
     * @param string $filename
     * @param FilesRepository $repository
     * @return Response
     */
    public function filesDeleteAction($filename, FilesRepository $repository)
    {
        $repository->delete($filename);
        return $this->redirect($this->generateUrl('admin.screen.files'));
    }

    /**
     * @Route("/effects", name="admin.screen.effects")
     * @param EffectsRepository $repository
     * @return Response
     */
    public function effectsAction(EffectsRepository $repository)
    {
        return $this->render('admin/screen/effects.html.twig', [
            'effects' => $repository->getAll()
        ]);
    }

    /**
     * @Route("/effects/activate/{effect}", name="admin.screen.effects.activate", methods={"POST"})
     * @param string $effect
     * @param Request $request
     * @param EffectsRepository $repository
     * @return Response
     */
    public function effectsActivateAction($effect, Request $request, EffectsRepository $repository)
    {
        $repository->setEffect($effect, $request->get('data', []));

        return $this->redirect($this->generateUrl('admin.screen.effects'));
    }

    /**
     * @Route("/screens", name="admin.screen.screens")
     * @param ScreensRepository $repository
     * @return Response
     */
    public function screensAction(ScreensRepository $repository)
    {
        return $this->render('admin/screen/screens.html.twig', [
            'screens' => $repository->getAll()
        ]);
    }

    /**
     * @Route("/screens/edit/{id}", name="admin.screen.screens.edit")
     * @param mixed $id
     * @param Request $request
     * @param ScreensRepository $repository
     * @return Response
     */
    public function editAction($id, Request $request, ScreensRepository $repository)
    {
        /*$em = $this->getDoctrine()->getManager();
        $screen = $repository->getById($id);
        $formClass = 'AppBundle\Form\\' . ucfirst($screen->screenType) .  'Form';
        $form = $this->createForm($formClass, $screen->config, ['entity_manager' => $em]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $screen->config = $form->getData();
            $em->persist($screen);
            $em->flush();

            $this->addFlash('success', 'Gespeichert!');
            return $this->redirectToRoute('admin.screen.screens.edit', ['id' => $id]);
        }

        $template = 'admin/screen/forms/' . $screen->screenType . '.html.twig';
        if (!$this->get('templating')->exists('admin/screen/forms/' . $screen->screenType . '.html.twig'))
        {
            $template = 'admin/screen/edit.html.twig';
        }

        return $this->render($template, [
            'form' => $form->createView(),
        ]);*/
    }

    /**
     * @Route("/screens/activate/{id}", name="admin.screen.screens.activate")
     * @param string $id
     * @param ScreensRepository $repository
     * @return JsonResponse
     */
    public function activateAction($id, ScreensRepository $repository)
    {
        $repository->activate((int) $id);
        return new JsonResponse(1);
    }
}
