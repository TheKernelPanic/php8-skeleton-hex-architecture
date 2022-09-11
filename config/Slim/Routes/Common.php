<?php
declare(strict_types=1);

use Slim\App;

return static function(App $application): void {

    $application
        ->get(
            pattern: '/',
            callable: Php8SkeletonHexArchitecture\Infrastructure\Http\Controller\Default\GetDefaultController::class
        );

};