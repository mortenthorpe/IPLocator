<?php

namespace App\Controller;

use App\Contract\IpProviderModelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;


class DefaultController extends AbstractController
{
    private ?LoggerInterface $logger;

    public function configure(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * @Route("/default", name="default")
     */
    public function index(Request $request, IpProviderModelInterface $ipApi)
    {
        $apiUrl = $ipApi->getApiUrl();
        $clientIp = $request->getClientIp();
        $apiUrlString = str_replace('{query}', $clientIp, $apiUrl);
        $this->logger->info($apiUrlString);


        return new Response($apiUrlString);
    }
}
