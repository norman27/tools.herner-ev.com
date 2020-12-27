<?php declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * @Route("/admin/cronjob")
 */
class CronjobController extends AbstractController
{
    /**
     * @Route("", name="admin.cronjob.index")
     * @return Response
     */
    public function indexAction(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TECH');
        return $this->render('admin/cronjob/index.html.twig');
    }

    /**
     * @Route("/execute/{job}", name="admin.cronjob.execute", requirements={"filename" = "[a-z0-9._-]+"})
     * @param string $job
     * @param KernelInterface $kernel
     * @return JsonResponse
     * @throws \Exception
     */
    public function executeAction(string $job, KernelInterface $kernel): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_TECH');

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'cronjob:table-update',
        ]);

        $output = new BufferedOutput();
        $application->run($input, $output);

        return new JsonResponse([
            'output' => $output->fetch()
        ]);
    }

    /**
     * @Route("/log", name="admin.cronjob.log")
     * @return Response
     */
    public function logAction(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_TECH');
        return $this->render('admin/cronjob/log.html.twig');
    }
}
