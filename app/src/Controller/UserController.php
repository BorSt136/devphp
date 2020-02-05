<?php

namespace devphp\Controller;

use devphp\Model\Entity\User;
use devphp\Model\Service\Database\User as UserService;
use devphp\Model\Service\Database\Category as CategoryService;

class UserController extends Controller
{
    private $userService;
    private $categoryService;

    public function __construct($templateEngine)
    {
        $this->userService = new UserService();
        $this->categoryService = new CategoryService();
        parent::__construct($templateEngine);
    }

    public function create()
    {
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            $user = new User();
            $user->setLogin($_POST["login"]);
            $user->setPassword($_POST["password"]);
            $this->userService->create($user);

            $this->connect();
        }

        echo $this->render('user/create.twig');
    }

    public function read()
    {
        //var_dump($this->userService->read($_GET["id"]));
        if (isset($_GET["id"])) {
            echo $this->render('user/read.twig', [
                'user' => $this->userService->read($_GET["id"])

            ]);
        } else {
            $this->displayList("Read", "Consultation", "Consultation d'utilisateur");
        }
    }

    public function update()
    {
        if (!$this->sessionService->isConnected()) {
            header('Location: /Awesomesitename/connection/');
        }
        /** @var User $user */
        $user = $this->connectedUser;
        $categories = $this->categoryService->list();
        //TO DO: sanitize POST
        if(isset($_POST["password"])) {
            $user->setPassword($_POST["password"]);
            $user->setEmail($_POST["email"]);
            $user->setNom($_POST["nom"]);
            $user->setPrenom($_POST["prenom"]);
            $user->setCategory($this->categoryService->read($_POST['categoryId']));
            $this->userService->update($user);
            $this->sessionService->create($user);
        }

        echo $this->render('user/update.twig', [
            "user" => $user,
            "categories" => $categories,
        ]);
    }

    public function delete()
    {
        if (isset($_GET["id"])) {
           $this->userService->delete($_GET["id"]);
        }

        $this->displayList("delete", "Suppression", "Suppression d'utilisateur");
    }

    public function connect()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->userService->getByLoginAndPassword($_POST['login'], $_POST['password']);
            if ($user->getId() !== null) {
                $this->sessionService->create($user);
                header('Location: /Awesomesitename/profil/?id=' . $user->getId());
            }
        }

        echo $this->render('user/connect.twig');
    }

    public function disconnect()
    {
        $this->sessionService->destroy();
        header('Location: /Awesomesitename/');
    }

    private function displayList(string $action, string $titre, string $subtitre)
    {
        echo $this->render('user/list.twig', [
            'users' => $this->userService->list(),
            'titre' => $titre,
            'subTitre' => $subtitre,
            'controller' => 'User',
            'action' => $action
        ]);
    }
}