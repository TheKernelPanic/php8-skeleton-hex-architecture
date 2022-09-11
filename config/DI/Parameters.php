<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return static function(ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions(
        definitions: array(
            'parameters' => array(
                'environment_mode' => $_ENV['ENVIRONMENT'],
                'logger' => array(
                    'directory' => $_ENV['LOGGER_DIRECTORY'],
                    'rotation' => $_ENV['LOGGER_FILE_ROTATION'] === 'true',
                    'filename' => $_ENV['LOGGER_FILE_NAME'],
                    'app_name' => $_ENV['LOGGER_APP_NAME'],
                    'permissions' => 0664
                )
            )
        )
    );
};