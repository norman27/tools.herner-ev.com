<?php

namespace AppBundle\Controller;

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
use AppBundle\Repository\ForceReloadRepository;
use AppBundle\Repository\EffectsRepository;
use AppBundle\Repository\Screen\AudioRepository;

class AdminController extends Controller
{
    /**
     * @Route("/admin/audio/track/{track}", name="admin.audio.track", defaults={"track"=0})
     *
     * @param string $track
     * @return JsonResponse
     */
    public function audioTrackAction($track)
    {
        //@TODO remove this stub

        if ($track == '0') {
            $track = '';
        } elseif ($track == '1') {
            $track = '/audio/silence.mp3';
        } else {
            $track = '/audio/the-unforgiven.mp3';
        }

        $repository = new AudioRepository($this->get('cache.app'));

        return new JsonResponse([
            $repository->setTrack($track)
        ]);
    }

    /**
     * @Route("/admin/audio/volume/{volume}", name="admin.audio.volume", defaults={"volume"=80})
     *
     * @param string $volume
     * @return JsonResponse
     */
    public function audioVolumeAction($volume)
    {
        //@TODO remove this stub

        $volume = (int) $volume;
        $repository = new AudioRepository($this->get('cache.app'));

        return new JsonResponse([
            $repository->setVolume($volume)
        ]);
    }

    /**
     * @Route("/admin{trailingSlash}", name="admin", requirements={"trailingSlash" = "[/]{0,1}"}, defaults={"trailingSlash" = "/"})
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig', [
            'screens' => $this->getScreenRepository()->getAllForActiveCategory(),
            'categoryName' => $this->getScreenRepository()->getCategoryTranslated()
        ]);
    }

    /**
     * @Route("/admin/effects/{effect}", name="admin.effects", defaults={"effect"=null})
     *
     * @param string $effect
     * @return Response
     */
    public function effectsAction(Request $request, $effect) {
        if ($effect !== null) {
            $this->getEffectsRepository()->setEffect($effect, $request->get('data', ''));
            return new JsonResponse(1);
        }
        return $this->render('admin/effects.html.twig', []);
    }

    /**
     * @Route("/admin/category/{category}", name="admin.category", defaults={"category"=null})
     *
     * @param string $category
     * @return Response
     */
    public function categoryAction($category) {
        $repository = $this->getScreenRepository();

        if ($category !== null) {
            $oldCategory = $repository->getCategory();
            $repository->setCategory((int) $category);

            if ($oldCategory != $category) {
                $this->getForceReloadRepository()->setForceReload(true);
            }
        }

        return $this->render('admin/category.html.twig', [
            'category' => $repository->getCategory(),
            'categoryName' => $repository->getCategoryTranslated()
        ]);
    }

    /**
     * @Route("/admin/reload/{force}", name="admin.reload", defaults={"force"=null})
     *
     * @param string $force
     * @return Response
     */
    public function reloadAction($force) {
        if ($force == 1) {
            $this->getForceReloadRepository()->setForceReload(true);
        }
        return $this->render('admin/reload.html.twig', [
            'categoryName' => $this->getScreenRepository()->getCategoryTranslated()
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin.edit")
     *
     * @param Request $request
     * @param mixed $id
     * @return Response
     */
    public function editAction(Request $request, $id) {
        $repository = $this->getScreenRepository();
        $em         = $this->getDoctrine()->getManager();
        $screen     = $repository->getById($id);
        $formClass  = 'AppBundle\Form\\' . ucfirst($screen->screenType) .  'Form';
        $form       = $this->createForm($formClass, $screen->config, ['entity_manager' => $em]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $screen->config = $form->getData();
            $em->persist($screen);
            $em->flush();

            $this->addFlash('success', 'Gespeichert!');
            return $this->redirectToRoute('admin.edit', ['id' => $id]);
        }

        $template = 'admin/forms/' . $screen->screenType . '.html.twig';
        if (!$this->get('templating')->exists('admin/forms/' . $screen->screenType . '.html.twig')) {
            $template = 'admin/edit.html.twig';
        }

        return $this->render($template, [
            'form' => $form->createView(),
            'categoryName' => $this->getScreenRepository()->getCategoryTranslated()
        ]);
    }

    /**
     * @Route("/admin/files", name="admin.files")
     *
     * @param Request $request
     * @return Response
     */
    public function filesAction(Request $request) {
        $files = new FilesRepository();
        $form = $this->createForm(FileUploadForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->getData()['file'];

            $file->move(
                $this->getParameter('media_directory'),
                $files->simplifyFilename($file->getClientOriginalName())
            );

            return $this->redirect($this->generateUrl('admin.files'));
        }

        return $this->render('admin/files.html.twig', [
            'files' => $files->getAllFiles(),
            'form' => $form->createView(),
            'categoryName' => $this->getScreenRepository()->getCategoryTranslated()
        ]);
    }

    /**
     * @Route("/admin/files/delete/{filename}", name="admin.files.delete", requirements={"filename" = "[a-z0-9._-]+"})
     *
     * @param string $filename
     * @return Response
     */
    public function filesDeleteAction($filename) {
        $files = new FilesRepository();
        $files->delete($filename);

        return $this->redirect($this->generateUrl('admin.files'));
    }

    /**
     * @Route("/admin/activate/{id}", name="admin.activate")
     *
     * @param int $id
     * @return JsonResponse
     */
    public function activateAction($id) {
        $repository = $this->getScreenRepository();
        $em         = $this->getDoctrine()->getManager();
        $activeCat  = (int) $this->getScreenRepository()->getCategory();

        $query = $em->createQuery('UPDATE AppBundle:Screen s SET s.active = 0 WHERE s.category = ' . $activeCat);
        $query->execute();

        $screen = $repository->getById($id);
        $screen->active = Screen::IS_ACTIVE;
        $em->persist($screen);
        $em->flush();

        return new JsonResponse(1);
    }

    /**
     * @return ScreenRepository
     */
    private function getScreenRepository() {
        return new ScreenRepository($this->getDoctrine());
    }

    /**
     * @return ForceReloadRepository
     */
    private function getForceReloadRepository() {
        return new ForceReloadRepository();
    }

    /**
     * @return EffectsRepository
     */
    private function getEffectsRepository() {
        return new EffectsRepository();
    }
}
