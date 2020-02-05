<?php

namespace devphp\Controller;

use devphp\Model\Service\Session\User as SessionService;

abstract class Controller
{
    /** @var \Twig\Environment  */
    protected $templateEngine;
    /**
     * @var SessionService
     */
    protected $sessionService;
    /**
     * @var \devphp\Model\Entity\User|null
     */
    protected $connectedUser;

    public function __construct($templateEngine)
    {
        $this->templateEngine = $templateEngine;
        //try
        $this->sessionService = new SessionService();
        //catch
        $this->connectedUser = $this->sessionService->get();
    }

    protected function render(string $vue, array $args = []): string {
        return $this->templateEngine->render($vue, array_merge([
            'isConnected' => $this->sessionService->isConnected(),
            'connectedUser' => $this->connectedUser,
        ], $args));
    }
}