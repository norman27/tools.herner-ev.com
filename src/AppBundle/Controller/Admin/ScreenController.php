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
     * @Route("/audio", name="admin.screen.audio", options={"expose"=true})
     * @return Response
     */
    public function audioAction()
    {
        $audioRepository = new AudioRepository($this->get('cache.app'));
        $audio = $audioRepository->get();
        return $this->render('admin/screen/audio.html.twig', [
            'volume' => $audio->volume,
            'track' => $audio->track
        ]);
    }

    /**
     * @Route("/audio/tracks", name="admin.screen.audio.tracks", options={"expose"=true})
     * @return Response
     */
    public function getAudioTracks() {
        $audioRepository = new AudioRepository($this->get('cache.app'));
        return new JsonResponse([
            'tracks' => $audioRepository->getAvailableTracks()
        ]);
    }

    /**
     * @Route("/audio/volume/{volume}", name="admin.screen.audio.volume", options={"expose"=true}, defaults={"volume"=80}, methods={"POST"})
     * @param string $volume
     * @return JsonResponse
     */
    public function postAudioVolumeAction($volume) // @TODO this should be more something like "change"
    {
        $repository = new AudioRepository($this->get('cache.app'));
        return new JsonResponse([
            $repository->setVolume((int) $volume)
        ]);
    }

    /**
     * @Route("/audio/track/{track}", name="admin.screen.audio.track", options={"expose"=true}, defaults={"track"=""}, methods={"POST"})
     * @param string $track
     * @return JsonResponse
     */
    public function postAudioTrackAction($track) // @TODO this should be more something like "change"
    {
        $repository = new AudioRepository($this->get('cache.app'));
        return new JsonResponse([
            $repository->setTrack($track)
        ]);
    }

    /**
     * @Route("/files", name="admin.screen.files")
     * @param Request $request
     * @return Response
     */
    public function filesAction(Request $request)
    {
        $repository = new FilesRepository($this->getParameter('media_screen_directory'));

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
     * @return Response
     */
    public function filesDeleteAction($filename)
    {
        $files = new FilesRepository($this->getParameter('media_screen_directory'));
        $files->delete($filename);

        return $this->redirect($this->generateUrl('admin.screen.files'));
    }

    /**
     * @Route("/effects", name="admin.screen.effects")
     * @return Response
     */
    public function effectsAction()
    {
        $repository = new EffectsRepository($this->get('cache.app'));
        return $this->render('admin/screen/effects.html.twig', [
            'effects' => $repository->getAll()
        ]);
    }

    /**
     * @Route("/effects/activate/{effect}", name="admin.screen.effects.activate", methods={"POST"})
     * @param Request $request
     * @param string $effect
     * @return Response
     */
    public function effectsActivateAction(Request $request, $effect)
    {
        $repository = new EffectsRepository($this->get('cache.app'));
        $repository->setEffect($effect, $request->get('data', []));

        return $this->redirect($this->generateUrl('admin.screen.effects'));
    }

    /**
     * @Route("/screens", name="admin.screen.screens")
     * @return Response
     */
    public function screensAction()
    {
        $repository = new ScreensRepository($this->getDoctrine());
        return $this->render('admin/screen/screens.html.twig', [
            'screens' => $repository->getAll()
        ]);
    }

    /**
     * @Route("/screens/edit/{id}", name="admin.screen.screens.edit")
     * @param Request $request
     * @param mixed $id
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $repository = new ScreensRepository($this->getDoctrine());
        $em         = $this->getDoctrine()->getManager();
        $screen     = $repository->getById($id);
        $formClass  = 'AppBundle\Form\\' . ucfirst($screen->screenType) .  'Form';
        $form       = $this->createForm($formClass, $screen->config, ['entity_manager' => $em]);

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
        ]);
    }

    /**
     * @Route("/screens/activate/{id}", name="admin.screen.screens.activate")
     * @param int $id
     * @return JsonResponse
     */
    public function activateAction($id)
    {
        $repository = new ScreensRepository($this->getDoctrine());
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('UPDATE AppBundle:Screen s SET s.active = 0');
        $query->execute();

        $screen = $repository->getById($id);
        $screen->active = Screen::IS_ACTIVE;
        $em->persist($screen);
        $em->flush();

        return new JsonResponse(1);
    }
}
