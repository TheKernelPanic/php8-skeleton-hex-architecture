<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Application\Handler;

use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpNotImplementedException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Handlers\ErrorHandler;

class HttpErrorHandler extends ErrorHandler
{
    public const BAD_REQUEST = 'BAD_REQUEST';
    public const NOT_ALLOWED = 'NOT_ALLOWED';
    public const NOT_IMPLEMENTED = 'NOT_IMPLEMENTED';
    public const RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';
    public const SERVER_ERROR = 'SERVER_ERROR';
    public const UNAUTHENTICATED = 'UNAUTHENTICATED';

    /**
     * @return ResponseInterface
     */
    protected function respond(): ResponseInterface
    {
        switch (true) {
            case $this->exception instanceof HttpNotFoundException:
                $type = self::RESOURCE_NOT_FOUND;
                $statusCode = 404;
                break;

            case $this->exception instanceof HttpMethodNotAllowedException:
                $type = self::NOT_ALLOWED;
                $statusCode = 405;
                break;

            case $this->exception instanceof HttpUnauthorizedException:
                $type = self::UNAUTHENTICATED;
                $statusCode = 401;
                break;

            case $this->exception instanceof HttpForbiddenException:
                $type = self::NOT_ALLOWED;
                $statusCode = 403;
                break;

            case $this->exception instanceof HttpBadRequestException:
                $type = self::BAD_REQUEST;
                $statusCode = 400;
                break;

            case $this->exception instanceof HttpNotImplementedException:
                $type = self::NOT_IMPLEMENTED;
                $statusCode = 501;
                break;

            default:
                $type = self::SERVER_ERROR;
                $statusCode = 500;
        }

        if (!$this->exception instanceof HttpMethodNotAllowedException) {
            $this->logger->error(message: $this->exception->getMessage());
        }

        $error = [
            'error' => $type
        ];
        if ($this->displayErrorDetails) {
            $error['message'] = $this->exception->getMessage();
        }
        $payload = json_encode($error, JSON_PRETTY_PRINT);

        $response = $this->responseFactory->createResponse(code: $statusCode);
        $response->getBody()->write(string: $payload);

        return $response->withStatus(code: $statusCode);
    }
}