<?php

namespace App\Controller\Admin\Screen;

use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Screen\Effect\EffectsRepository;

/**
 * @Route("/admin/screen/effects")
 */
class EffectsController extends AbstractController
{
    /**
     * @Route("", name="admin.screen.effects")
     * @param EffectsRepository $repository
     * @return Response
     */
    public function effectsAction(EffectsRepository $repository)
    {
        $this->denyAccessUnlessGranted('ROLE_SCREEN');
        return $this->render('admin/screen/effects.html.twig', [
            'effects' => $repository->getAll()
        ]);
    }

    /**
     * @Route("/activate/{effect}", name="admin.screen.effects.activate", methods={"POST"})
     * @param string $effect
     * @param Request $request
     * @param EffectsRepository $repository
     * @return Response
     * @throws InvalidArgumentException
     */
    public function effectsActivateAction($effect, Request $request, EffectsRepository $repository)
    {
        $this->denyAccessUnlessGranted('ROLE_SCREEN');
        $repository->setEffect($effect, $request->get('data', []));
        return $this->redirect($this->generateUrl('admin.screen.effects'));
    }
}
