<?php

namespace App\Controller\Admin\Screen;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Screen\ScreensRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/screen")
 * @Security("has_role('ROLE_SCREEN')")
 */
class ScreensController extends AbstractController
{
    /**
     * @Route("/screens", name="admin.screen.screens", options={"expose"=true})
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
     * @Route("/screens/edit/{id}", name="admin.screen.screens.edit", options={"expose"=true})
     * @param mixed $id
     * @param Request $request
     * @param ScreensRepository $repository
     * @return Response
     */
    public function editAction($id, Request $request, ScreensRepository $repository)
    {
        $screen = $repository->getById($id);

        $formClass = 'App\Admin\Screen\Edit\\' . ucfirst($screen->screenType) .  'Form';
        $form = $this->createForm(
            $formClass,
            $screen->config,
            [
                'action' => $this->generateUrl('admin.screen.screens.edit', ['id' => $id]),
            ]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) //@TODO check how to trigger an invalid form? does not seem to work...
        {
            $screen->config = $form->getData();
            $repository->save($screen);

            $this->addFlash('success', 'Erfolgreich gespeichert');
        }

        $template = ($this->get('templating')->exists('admin/screen/edit/' . $screen->screenType . '.html.twig')) ?
            'admin/screen/edit/' . $screen->screenType . '.html.twig'
            : $template = 'admin/screen/edit/form.html.twig';

        return $this->render($template, [
            'screen' => $screen,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/screens/list", name="admin.screen.screens.list", options={"expose"=true})
     * @param ScreensRepository $repository
     * @return JsonResponse
     */
    public function listAction(ScreensRepository $repository)
    {
        return new JsonResponse([
            'screens' => $repository->getAll() // @TODO this contains too much data in "config"
        ]);
    }

    /**
     * @Route("/screens/activate/{id}", name="admin.screen.screens.activate", options={"expose"=true})
     * @param string $id
     * @param ScreensRepository $repository
     * @return Response
     */
    public function activateAction($id, ScreensRepository $repository)
    {
        $repository->activate((int) $id);
        return $this->redirect($this->generateUrl('admin.screen.screens'));
    }
}
