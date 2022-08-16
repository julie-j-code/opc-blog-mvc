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
}
