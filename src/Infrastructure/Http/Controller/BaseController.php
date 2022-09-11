<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Infrastructure\Http\Controller;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;

abstract class BaseController
{
    /**
     * @param ContainerInterface $container
     * @return void
     */
    public function __construct(
        protected ContainerInterface $container
    ){
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    protected function render(
        ServerRequestInterface $request,
        ResponseInterface $response,
        string $template, array
        $data = []): ResponseInterface
    {
        try {
            return $this->container->get('view')->render(
                response: $response,
                template: $template,
                data: $data
            );
        } catch (ContainerExceptionInterface|NotFoundExceptionInterface $exception) {
            throw new HttpInternalServerErrorException(
                request: $request,
                message: $exception->getMessage()
            );
        }
    }
}