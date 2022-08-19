<?php

// Chargement des classes
require_once('model/DbManager.php');
require_once('model/UsersManager.php');


function register($pseudo, $email, $password)
{
    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();
    $nb_pseudo = $usersManager->check_pseudo($pseudo);
    $affectedLines = $usersManager->register($pseudo, $email, $password);
    if ($nb_pseudo > 0) {
        throw new Exception('Ce pseudo existe déjà', 0, null);
        header('Location: index.php?action=register');
    } else if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter cet utilisateur !');
    } else {
        header('Location: index.php');
    }

    require('view/frontend/userRegisterView.php');
}

function login($pseudo, $password)
{

    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();
    $user = $usersManager->login($pseudo, $password);
    require('view/frontend/userLoginView.php');
}

function profil()
{

    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();
    $user = $usersManager->profil();
    require('view/frontend/profilView.php');
}

function editUser($updatedPseudo, $updatedEmail)
{
    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();
    $affectedLines = $usersManager->editUser($updatedPseudo, $updatedEmail);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter cet utilisateur !');
    } else {
        header('Location: index.php');
    }

    require('view/frontend/editProfilView.php');
}
