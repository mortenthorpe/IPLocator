<?php

namespace App\Controller;

use App\Contract\IpProviderModelInterface;
use App\Helper\ClientIPTrait;
use App\Helper\HttpResponseTrait;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints as Assert;


class DefaultController extends AbstractController
{
    use ClientIPTrait;
    use HttpResponseTrait;

    private ?LoggerInterface $logger;

    public function configure(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/default", name="default")
     */
    public function index(Request $request, IpProviderModelInterface $ipApi, ClientInterface $httpClient)
    {
        $apiUrl = $ipApi->getApiUrl();
        $reqGetClientIp = $request->get('ip', '');
        // Let the GET-parameter 'ip' determine a manually set clientIP address, fallback to the request client IP.
        $clientIp = $this->getClientIPValueOrFallback($reqGetClientIp, $request->getClientIp());
        $apiUrlString = str_replace('{query}', $clientIp, $apiUrl);
        /**
         * @var ResponseInterface $apiResponse
         */
        $apiResponse = $httpClient->request(Request::METHOD_GET, $apiUrlString);
        if($this->HttpResponseSuccess($apiResponse, Request::METHOD_GET)) {
        $apiResponseData = $apiResponse->getBody()->getContents();
        $this->logger->info($apiResponseData);
        $apiResponseDataAssoc = unserialize($apiResponseData);
        try {
            $clientCountryCode = $apiResponseDataAssoc['countryCode'];
        } catch (\ErrorException $e) {
            $this->logger->notice('The IP-address \'{ip}\' is not resolvable to a location', ['ip' => $clientIp]);
        }
	}

        return new JsonResponse($apiResponseDataAssoc);
    }


}
