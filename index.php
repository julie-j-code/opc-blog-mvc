<?php

session_start();
require('controllers/comments.php');
require('controllers/posts.php');
require('controllers/users.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        // les actions
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addPost') {
            if (isset($_POST['newPost'])) {
                if (
                    !isset($_POST["title"], $_POST["content"])
                    || empty($_POST["title"]) || empty($_POST["content"])
                ) {
                    throw new Exception("Le formulaire est incomplet");
                } else {
                    $title = strip_tags($_POST["title"]);
                    $content = $_POST["content"];
                    addPost($title, $content);
                }
            }
        } elseif ($_GET['action'] === 'editPost') {

            // si on a bien récupéré l'id on peut afficher la page du formulaire
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                editPostView();
            }
                // si le formulaire a été soumis, traitement habituel
                var_dump(isset($_POST['editPost']));
                if (isset($_POST['editPost'])) {
                    // if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (
                        !isset($_POST["updatedTitle"], $_POST["updatedContent"])
                        || empty($_POST["updatedTitle"]) || empty($_POST["updatedContent"])
                    ) {
                        throw new Exception("Le formulaire est incomplet");
                    }
                    $id = $_POST["id"];
                    $title = strip_tags($_POST["updatedTitle"]);
                    $content = $_POST["updatedContent"];

                    editPost($title, $content, $id);
                
            }
        } elseif ($_GET['action'] === 'profil') {
            include_once('view/frontend/profilView.php');
        } elseif ($_GET['action'] === 'register') {
            registerUserView();
            if (isset($_POST['register'])) {
                if (
                    isset($_POST["email"], $_POST["pseudo"], $_POST["password"])
                    && !empty($_POST["email"]) && !empty($_POST["pseudo"]) &&  !empty($_POST["password"])
                ) {
                    // le formulaire est complet
                    // on récupère les données en les protégeant
                    $pseudo = strip_tags($_POST["pseudo"]);
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Cet email n'est pas valable");
                    } else {
                        $email = $_POST["email"];
                    }
                    // on va hasher le password
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    // on enregistre en base :
                    register($pseudo, $email, $password);
                } else {
                    throw new Exception("Le formulaire est incomplet");
                    include_once('view/frontend/userRegisterView.php');
                }
            }
        } elseif ($_GET['action'] === 'login') {
            loginUserView();
            if (isset($_POST['login'])) {
                if (
                    isset($_POST["pseudo"], $_POST["password"])
                    && !empty($_POST["pseudo"]) &&  !empty($_POST["password"])
                ) {
                    // le formulaire est complet
                    // on récupère les données en les protégeant
                    $pseudo = strip_tags($_POST["pseudo"]);
                    // on ne hash pas le password au niveau du login, surtout pas
                    $password = $_POST["password"];
                    // on enregistre en base :
                    login($pseudo, $password);
                } else {
                    throw new Exception("Le formulaire est incomplet");
                    include_once('view/frontend/userLoginView.php');
                }
            }
        } elseif ($_GET['action'] === 'editUser') {
            editUserView();
            if (isset($_POST['submit'])) {
                if (
                    !isset($_POST["updatedEmail"], $_POST["updatedPseudo"])
                    || empty($_POST["updatedEmail"]) || empty($_POST["updatedPseudo"])
                ) {
                    throw new Exception("Le formulaire est incomplet");
                } elseif (!filter_var($_POST["updatedEmail"], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Cet email n'est pas valable");
                } else {
                    $updatedPseudo = strip_tags($_POST["updatedPseudo"]);
                    $updatedEmail = $_POST["updatedEmail"];
                    // et comme la requête va se faire sur la base du pseudo récupéré depuis la session, pseudo unique en base,  on peut se passer de récupérer l'id
                    editUser($updatedPseudo, $updatedEmail);
                }
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        listPosts();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
