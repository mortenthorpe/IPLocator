<?php


namespace App\Helper;


use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponseTrait
{
    /**
     * @param ResponseInterface $response
     * @param string $requestMethod
     *
     * @return bool
     * @throws InvalidArgumentException
     *
     */
    private function HttpResponseSuccess(ResponseInterface $response, string $requestMethod): bool
    {
        if (!in_array(strtoupper($requestMethod), [Request::METHOD_GET, Request::METHOD_POST])) {
            throw new InvalidArgumentException(sprintf('Request method %s is invalid', $requestMethod));
        }
        $responseStatusCode = $response->getStatusCode();
        $responseSuccessMethodCritMap = [
            Request::METHOD_GET => ($responseStatusCode === Response::HTTP_OK),
            Request::METHOD_POST => ($responseStatusCode === Response::HTTP_OK || $responseStatusCode === Response::HTTP_CREATED)
        ];

        return ($responseSuccessMethodCritMap[$requestMethod]);
    }

}
