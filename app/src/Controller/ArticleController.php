<?php

namespace devphp\Controller;

use devphp\Model\Entity\Article as ArticleModel;
use devphp\Model\Service\Database\Article as ArticleService;
use devphp\Model\Service\Database\Tag as TagService;
class ArticleController extends Controller
{
    private $articleService;
    private $tagService;
    public function __construct($templateEngine)
    {
        $this->articleService = new ArticleService();
        $this->tagService = new TagService();
        parent::__construct($templateEngine);
    }

    public function create()
    {
        if (isset($_POST["title"]) && isset($_POST["content"])) {
            $article = new ArticleModel();
            $article->setContent($_POST["content"]);
            $article->setTitle($_POST["title"]);
            $article->setAuthor($this->connectedUser);
            $this->articleService->create($article);
        }

        echo $this->render('article/create.twig');
    }

    public function read()
    {
        if (isset($_GET["id"])) {
            echo $this->render('article/read.twig', [
                'article' => $this->articleService->read($_GET["id"]),
            ]);
        } else {
            $this->displayList("read", "Consultation", "Consultation d'article", $this->articleService->list());
        }

    }

    public function update()
    {
        if (isset($_GET["id"])) {
            $article = $this->articleService->read($_GET["id"]);

            if (isset($_POST["title"]) && isset($_POST["content"])) {
                $article->setContent($_POST["content"]);
                $article->setTitle($_POST["title"]);
                if ($_POST["tagId"] == '')
                {
                    $article->setTag(NULL);
                }
                else
                {
                    $article->setTag($_POST["tagId"]);
                }

                $this->articleService->update($article);
            }
            $this->tagService = $this->tagService->list();
            $this->tagService[] = ['','',''];
            echo $this->render('article/update.twig', [
                'article' => $article,
                'tags' => $this->tagService
            ]);
        } else {
            $this->displayList("update", "Modification", "Modification d'article", $this->articleService->list());
        }
    }

    public function delete()
    {
        if (isset($_GET["id"])) {
           $this->articleService->delete($_GET["id"]);
        }

        $this->displayList("delete", "Suppression", "Suppression d'article", $this->articleService->list());
    }

    public function readMine()
    {
        if (!$this->sessionService->isConnected()) {
            header('Location: /Awesomesitename/connection/');
        }

        $myArticles = [];
        $articles = $this->articleService->list();
        foreach($articles as $article) {
            if ($article->getAuthor() !== null && $article->getAuthor()->getId() === $this->connectedUser->getId()) {
                $myArticles[] = $article;
            }
        }

        $this->displayList("read", "Mes articles", "Mes articles", $myArticles);

    }

    private function displayList(string $action, string $titre, string $subtitre, array $articles)
    {
        echo $this->render('article/list.twig', [
            'articles' => $articles,
            'titre' => $titre,
            'subTitre' => $subtitre,
            'controller' => 'Article',
            'action' => $action
        ]);
    }
}
