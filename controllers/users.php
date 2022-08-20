<?php

// Chargement des classes

require_once('model/UsersManager.php');

function registerUserView(){
    require('view/frontend/userRegisterView.php');
}

function register($pseudo, $email, $password)
{
    $usersManager = new Model\UsersManager();
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

    
}

function loginUserView(){
    require('view/frontend/userLoginView.php');
}

function login($pseudo, $password)
{

    $usersManager = new Model\UsersManager();
    $user = $usersManager->login($pseudo, $password);    
}

function profil()
{

    $usersManager = new Model\UsersManager();
    $user = $usersManager->profil();
    require('view/frontend/profilView.php');
}

function editUserView(){

    require('view/frontend/editProfilView.php');

}

function editUser($updatedPseudo, $updatedEmail)
{
    $usersManager = new Model\UsersManager();

    $usersManager->editUser($updatedPseudo, $updatedEmail);

    // require('view/frontend/editProfilView.php');
}
