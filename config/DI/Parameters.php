<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return static function(ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions(
        definitions: array(
            'parameters' => array(
                'environment_mode' => $_ENV['ENVIRONMENT']
            )
        )
    );
};