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
            die("L'utilisateur et/ou le mot de passe est incorrecte");
        }

        var_dump($password, $user['password']);
        // à ce stade, on a un user existant
        if (!password_verify($password,$user['password'])) {
            die("???");
        }



        // ici l'utilisateur et le mot de passe sont corrects
        // on va pouvoir ouvrir la session
        session_start();
        // y stocker les information qu'on souhaite
        $_SESSION['user'] = [
            "id" => $user["id"],
            "pseudo" => $user["pseudo"]
        ];

        // on redirige ici, à ce stade, vers la page d'accueil
        header("Location: index.php");

        return $user;
        
    }
}
