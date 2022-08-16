<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/DbManager.php");

class UsersManager extends DbManager
{
    public function register($pseudo, $email, $password)
    {
        $db = $this->dbConnect();
       $req=$db->prepare ('INSERT INTO users(pseudo, email, password) VALUES(?, ?, ?)');
        $affectedLines = $req->execute(array($pseudo, $email, $password));

        return $affectedLines;




    }
}
