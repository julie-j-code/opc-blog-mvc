<?php

require_once("models/DbManager.php");

class UsersManager extends DbManager
{
    public DbManager $connect;
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


        $id = $db->lastInsertId();
        session_start();

        $_SESSION['user'] = [
            "id" => $id,
            "email" => $email,
            "pseudo" => $pseudo
        ];

        // var_dump($_SESSION);

        return $affectedLines;
    }

    public function login($pseudo, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($pseudo));
        $user = $req->fetch();


        if (!$user) {
            throw new Exception("L'utilisateur et/ou le mot de passe est incorrect");
        }

        // var_dump($password, $user['password']);
        // à ce stade, on a un user existant
        if (!password_verify($password, $user['password'])) {
            throw new Exception("L'utilisateur et/ou le mot de passe est incorrect");
        }

        // on va pouvoir ouvrir la session
        session_start();
        // y stocker les information qu'on souhaite
        $_SESSION['user'] = [
            "email" => $user["email"],
            "pseudo" => $user["pseudo"]
        ];

        // on redirige vers la page profil
        header("Location: index.php?action=profil");

        return $user;
    }



    public function profil()    {

        header("Location: index.php?action=profil");
    }

    public function editUser($updatedPseudo, $updatedEmail)
    {
        $db = $this->dbConnect();
        $pseudo = $_SESSION['user']['pseudo'];
        $req = $db->prepare("UPDATE users SET pseudo=:pseudo, email=:email WHERE pseudo='$pseudo'");
        $req->bindValue(':pseudo', $updatedPseudo);
        $req->bindValue(':email', $updatedEmail);
        $affectedLines = $req->execute();

        $_SESSION['user']['pseudo'] = $updatedPseudo;
        $_SESSION['user']['email'] = $updatedEmail;
        // session_destroy();


        // on redirige vers la page profil
        header("Location: index.php?action=profil");
    }
}
