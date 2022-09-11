<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Infrastructure\Http\Controller\Default;

use Php8SkeletonHexArchitecture\Infrastructure\Http\Controller\BaseController;
use Php8SkeletonHexArchitecture\Infrastructure\Http\Controller\HttpControllerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetDefaultController extends BaseController implements HttpControllerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $response->withStatus(
            code: 204
        );
    }
}