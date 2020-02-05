<?php

namespace ProjetWeb\Controller;

use ProjetWeb\Model\Service\Database\Article as ArticleService;

class HomeController extends Controller
{
    private $articleService;

    public function __construct($templateEngine)
    {
        $this->articleService = new ArticleService();
        parent::__construct($templateEngine);
    }
    public function index()
    {
        echo $this->render('index.twig', [
            'articles' => $this->articleService->list(),
        ]);
    }

    public function page404()
    {
        header("HTTP/1.0 404 Not Found");

        echo "Error 404";
    }
}
