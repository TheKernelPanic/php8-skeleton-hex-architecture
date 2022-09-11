<?php
declare(strict_types=1);

use Php8SkeletonHexArchitecture\Application\Handler\HttpErrorHandler;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\Views\TwigMiddleware;

$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer(
    container: $container
);

$application = AppFactory::create();

$routes = require_once __DIR__ . '/../config/Slim/Routes/Common.php';
$routes($application);

$serverRequest = ServerRequestCreatorFactory::create()->createServerRequestFromGlobals();
$isDebugMode = $container->get('parameters')['environment_mode'] === 'DEV';

$httpErrorHandler = new HttpErrorHandler(
    callableResolver: $application->getCallableResolver(),
    responseFactory: $application->getResponseFactory()
);
$shutdownHandler = new \Php8SkeletonHexArchitecture\Application\Handler\ShutdownHandler(
    request: $serverRequest,
    httpErrorHandler: $httpErrorHandler,
    debugMode: $isDebugMode
);
$errorMiddleware = $application->addErrorMiddleware(
    displayErrorDetails: $isDebugMode,
    logErrors: $isDebugMode,
    logErrorDetails: $isDebugMode
);
$errorMiddleware->setDefaultErrorHandler(
    handler: $httpErrorHandler
);
$application->add(
    middleware: TwigMiddleware::createFromContainer(
        app: $application
    )
);

$application->run();