<?php

// Chargement des classes
require_once('model/DbManager.php');
require_once('model/UsersManager.php');

function login()
{
    // $postsManager = new \OpenClassrooms\Blog\Model\PostsManager();
    // $posts = $postsManager->getPosts();

    require('view/frontend/login.php');
}

function registration()
{

    require('view/frontend/userRegisterView.php');
}

function register($pseudo, $email, $password){
    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();

    // ça, c'est pour faire simple, parce qu'ici, vont s'insérer des instructions pour s'assurer qu'on a ce qu'il faut et sécuriser les données avant de les renvoyer au manager pour l'enregistrement. Sauf à renvoyer cette responsabilité au router...

    $affectedLines = $usersManager->register($pseudo, $email, $password);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter cet utilisateur !');
    }
    else {
        // parce que dans notre cas pour le moment, l'index sert de router
        header('Location: index.php?action=register');
        require('view/frontend/userRegisterView.php');
    }

    // require('view/frontend/userRegisterView.php');

}