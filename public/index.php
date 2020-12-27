<?php
use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * Loading Composer Configuration related to all essentials packages in our project.
 */
require dirname(__DIR__).'/vendor/autoload.php';

/**
 * Responsible for loading Environment Variables from .env files
 */
(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

/**
 * Setup all debugging tools
 */
if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}


$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
