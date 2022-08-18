<?php

// Chargement des classes
require_once('model/DbManager.php');
require_once('model/UsersManager.php');


function register($pseudo, $email, $password)
{    
    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();
    /* Verification de l'existance du pseudo dans la BDD. Plus nécessaire a priori puisque clé unique insérée dans la colonne pseudo de la table 
    Une requête préalable que je laisse pour l'instant cependant
    */
    $nb_pseudo = $usersManager->check_pseudo($pseudo);
    $affectedLines = $usersManager->register($pseudo, $email, $password);
    if ($nb_pseudo > 0) {        
        throw new Exception('Ce pseudo existe déjà', 0, null);
        header('Location: index.php?action=register');
    } else if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter cet utilisateur !');
    } else {
        // parce que dans notre cas pour le moment, l'index sert de router
        header('Location: index.php');
    }

    require('view/frontend/userRegisterView.php');

}

function login($pseudo, $password) {

    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();

    $user = $usersManager->login($pseudo, $password);

    require('view/frontend/userLoginView.php');

}

function profil() {

    $usersManager = new \OpenClassrooms\Blog\Model\UsersManager();

    // on verra pour l'édition plus tard. bien que rien de tout ça n'était requis à l'époque ni ne le soit aujourd'hui

    require('view/frontend/profilView.php');

}