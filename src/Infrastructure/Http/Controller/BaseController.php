<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Infrastructure\Http\Controller;

use Psr\Container\ContainerInterface;

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
}