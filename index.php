<?php

session_start();
error_reporting(E_ALL);
include_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/src/view');

$templateEngine = new \Twig\Environment($loader);
//activer options debug dump
$templateEngine->enableDebug();
$templateEngine->addExtension(new \Twig\Extension\DebugExtension());

$router = new ProjetWeb\Routing\Router(include 'src/Routing/routes.php');

try {
    $controllerName = 'ProjetWeb\\Controller\\' . ucfirst($router->getController()) . 'Controller';
    $action = $router->getAction();
} catch (\ProjetWeb\Exception\ControllerNotFoundException|\ProjetWeb\Exception\ActionNotFoundException $exception) {
    $controllerName = 'ProjetWeb\\Controller\\HomeController';
    $action = 'page404';
}
$controller = new $controllerName($templateEngine);


if (method_exists(get_class($controller), $action)) {
    $controller->$action();
} else {//superflu
    $controller = new ProjetWeb\Controller\HomeController();
    $controller->page404();
}