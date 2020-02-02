<?php

namespace App\Controller\Admin\Screen;

use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Screen\Audio\AudioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/screen/audio")
 * @Security("has_role('ROLE_SCREEN')")
 */
class AudioController extends Controller
{
    /**
     * @Route("", name="admin.screen.audio", options={"expose"=true})
     * @param AudioRepository $repository
     * @return Response
     * @throws InvalidArgumentException
     */
    public function audioAction(AudioRepository $repository)
    {
        $audio = $repository->get();
        return $this->render('admin/screen/audio.html.twig', [
            'volume' => $audio->volume,
            'track' => $audio->track
        ]);
    }

    /**
     * @Route("/tracks", name="admin.screen.audio.tracks", options={"expose"=true})
     * @param AudioRepository $repository
     * @return Response
     */
    public function getAudioTracks(AudioRepository $repository) {
        return new JsonResponse([
            'tracks' => $repository->getAvailableTracks()
        ]);
    }

    /**
     * @Route("/volume/{volume}", name="admin.screen.audio.volume", options={"expose"=true}, defaults={"volume"=80}, methods={"POST"})
     * @param string $volume
     * @param AudioRepository $repository
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function changeAudioVolumeAction($volume, AudioRepository $repository)
    {
        return new JsonResponse([
            $repository->setVolume((int) $volume)
        ]);
    }

    /**
     * @Route("/track/{track}", name="admin.screen.audio.track", options={"expose"=true}, defaults={"track"=""}, methods={"POST"})
     * @param string $track
     * @param AudioRepository $repository
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function changeAudioTrackAction($track, AudioRepository $repository)
    {
        return new JsonResponse([
            $repository->setTrack($track)
        ]);
    }
}
