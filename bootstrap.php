<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

(new Dotenv())->load(
    path: __DIR__ . '/.env'
);

$containerBuilder = new ContainerBuilder();

$parameters = require_once __DIR__ . '/config/DI/Parameters.php';
$parameters($containerBuilder);

$containerBuilder->useAnnotations(false);

return $containerBuilder->build();