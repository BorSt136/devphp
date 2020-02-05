<?php
namespace ProjetWeb\Routing;

use ProjetWeb\Exception\ActionNotFoundException;
use ProjetWeb\Exception\ControllerNotFoundException;

class Router
{
    /** @var string */
    private $uri;
    /** @var array */
    private $routes;

    /**
     * Router constructor.
     * @param array $routes
     * @throws \Exception
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $regexp = "/^\/projet-web\/([^?]+)[\?]?.*/";

        if(preg_match($regexp, $_SERVER['REQUEST_URI'], $captureGroups) !== false)
        {
            $this->uri = $captureGroups[1] ?? '';
        }
        else {
            throw new \Exception('AAAAAAAAAAAAH');
        }
    }

    /**
     * @return string
     * @throws ControllerNotFoundException
     */
    public function getController(): string
    {
        //echo "<pre>";
        //print_r($this);
        //echo "</pre>";
        if(array_key_exists($this->uri, $this->routes)){
            $array = $this->routes[$this->uri];
            return key($array);
        }

        throw new ControllerNotFoundException();
    }

    /**
     * @return string
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     */
    public function getAction(): string
    {
        //var_dump($this);
        $array = $this->routes[$this->uri];
        if(array_key_exists($this->getController(), $array)) {
            echo "<pre>";
            print_r($array[$this->getController()]);
            echo "</pre>";
            return $array[$this->getController()];
        }

        throw new ActionNotFoundException();
    }
}