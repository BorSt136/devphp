<?php

session_start();
error_reporting(E_ALL);
include_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/app/src/view');

$templateEngine = new \Twig\Environment($loader);
//activer options debug dump
$templateEngine->enableDebug();
$templateEngine->addExtension(new \Twig\Extension\DebugExtension());

$router = new devphp\Routing\Router(include 'app/src/Routing/routes.php');
echo $_SERVER['REQUEST_URI'];
try {
    $controllerName = 'devphp\\Controller\\' . ucfirst($router->getController()) . 'Controller';
    $action = $router->getAction();
} catch (\devphp\Exception\ControllerNotFoundException|\devphp\Exception\ActionNotFoundException $exception) {
    $controllerName = 'devphp\\Controller\\HomeController';
    $action = 'page404';
}
$controller = new $controllerName($templateEngine);


if (method_exists(get_class($controller), $action)) {
    $controller->$action();
} else {//superflu
    $controller = new devphp\Controller\HomeController();
    $controller->page404();
}