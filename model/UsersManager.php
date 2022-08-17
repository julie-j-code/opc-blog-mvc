<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/DbManager.php");

class UsersManager extends DbManager
{

    function check_pseudo($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nb_pseudo FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $nb_pseudo = $req->fetch();
        return $nb_pseudo['nb_pseudo'];
    }

    public function register($pseudo, $email, $password)
    {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(pseudo, email, password) VALUES(?, ?, ?)');
        $affectedLines = $req->execute(array($pseudo, $email, $password));

        // on récupère l'id du dernier utilisateur inscrit
        $id = $db->lastInsertId();

        // on démarre une sesssion
        // on connecte l'utilisateur
        session_start();

        $_SESSION['user'] = [
            "id" => $id,
            "email" => $email,
            "pseudo" => $pseudo
        ];

        var_dump($_SESSION);

        // on redirige à ce stade, vers la page d'accueil - ou ultérieurement la page d'édition de profil
        header("Location: index.php");

        return $affectedLines;
    }

    public function login($pseudo, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $user = $req->fetch();
        var_dump(password_verify($password, $user['password']));

        if (!$user) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        var_dump($password, $user['password']);
        // à ce stade, on a un user existant
        if (!password_verify($password, $user['password'])) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }



        // ici l'utilisateur et le mot de passe sont corrects
        // on va pouvoir ouvrir la session
        session_start();
        // y stocker les information qu'on souhaite
        $_SESSION['user'] = [
            "email" => $user["email"],
            "pseudo" => $user["pseudo"]
        ];

        // on redirige ici, à ce stade, vers la page d'accueil
        header("Location: index.php");

        return $user;
    }
}
