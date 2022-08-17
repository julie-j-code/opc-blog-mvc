<?php
require('controllers/comments.php');
require('controllers/posts.php');
require('controllers/users.php');

try {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'login') {
            if (isset($_POST)) {
                if (
                    isset($_POST["pseudo"], $_POST["password"])
                    && !empty($_POST["pseudo"]) &&  !empty($_POST["password"])
                ) {
                    // le formulaire est complet
                    // on récupère les données en les protégeant
                    $pseudo = strip_tags($_POST["pseudo"]);
                    // on ne hash pas le password au niveau du login
                    $password = $_POST["password"];
                    // on enregistre en base :
                    // vas-y manager, enregistre l'utilisateur !!!!
                    login($pseudo, $password);
                } else {
                    // die("Le formulaire est incomplet");
                    include_once('view/frontend/userLoginView.php');
                }
            }

        } elseif ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'register') {
            // on va écrire toute la logique qu'on utiliserait de manière procédurale  pour vérifier l'existence des données envoyées et les sécuriser
            if (isset($_POST)) {
                if (
                    isset($_POST["email"], $_POST["pseudo"], $_POST["password"])
                    && !empty($_POST["email"]) && !empty($_POST["pseudo"]) &&  !empty($_POST["password"])
                ) {
                    // le formulaire est complet
                    // on récupère les données en les protégeant
                    $pseudo = strip_tags($_POST["pseudo"]);
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        die("Cet email n'est pas valable");
                    } else {
                        $email = $_POST["email"];
                    }
                    // on va hasher le password
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    // on enregistre en base :
                    // vas-y manager, enregistre l'utilisateur !!!!
                    register($pseudo, $email, $password);
                } else {
                    // die("Le formulaire est incomplet");
                    include_once('view/frontend/userRegisterView.php');
                }
            }
        }
        elseif ($_GET['action'] == 'editProfil') {

            if (isset($_POST)) {
                if (
                    isset($_POST["email"], $_POST["pseudo"])
                    && !empty($_POST["email"]) && !empty($_POST["pseudo"])) {
                    $pseudo = strip_tags($_POST["pseudo"]);
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        die("Cet email n'est pas valable");
                    } else {
                        $email = $_POST["email"];
                    }
                    
                } else {
                    // die("Le formulaire est incomplet");
                    include_once('view/frontend/updateProfilView.php');
                }
            }




            # code...
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
