<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return static function(ContainerBuilder $containerBuilder): void {

    $definitions = array(
        'logger' => static function(ContainerInterface $container): LoggerInterface {
            $parameters = $container->get('parameters')['logger'];

            $logger = new Logger(
                name: $parameters['app_name']
            );
            $path = $parameters['directory'] . '/' . $parameters['filename'] . '.log';
            if ($parameters['rotation']) {
                $handler = new RotatingFileHandler(
                    filename: $path,
                    level: Level::Debug,
                    filePermission: $parameters['permissions']
                );
            } else {
                $handler = new StreamHandler(
                    stream: $path,
                    level: Level::Debug,
                    filePermission: $parameters['permissions']
                );
            }
            $logger->pushHandler(
                handler: $handler
            );

            return $logger;
        }
    );

    $containerBuilder->addDefinitions(
        definitions: $definitions
    );

};