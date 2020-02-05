<?php

namespace devphp\Controller;

use devphp\Model\Entity\Tag as TagEntity;
use devphp\Model\Service\Database\Tag as TagService;

class TagController extends Controller
{
    private $tagService;
    public function __construct($templateEngine)
    {
        $this->tagService = new tagService();
        $this->tagService = new TagService();
        parent::__construct($templateEngine);
    }
/*
    public function create()
    {
        if (isset($_POST["title"]) && isset($_POST["content"])) {
            $tag = new tagModel();
            $tag->setContent($_POST["content"]);
            $tag->setTitle($_POST["title"]);
            $tag->setAuthor($this->connectedUser);
            $this->tagService->create($tag);
        }

        echo $this->render('tag/create.twig');
    }
*/
    public function read()
    {
        if (isset($_GET["id"])) {
            echo $this->render('tag/read.twig', [
                'tag' => $this->tagService->read($_GET["id"]),
            ]);
        } else {
            $this->displayList("read", "Consultation", "Consultation d'tag", $this->tagService->list());
        }

    }

   /*
    public function delete()
    {
        if (isset($_GET["id"])) {
           $this->tagService->delete($_GET["id"]);
        }

        $this->displayList("delete", "Suppression", "Suppression d'tag", $this->tagService->list());
    }
*/


    private function taglist()
    {
        $this->tagService = $this->tagService->list();
        echo $this->render('tag/list.twig', [
            'tag' => $this->tagService
        ]);
    }
}
