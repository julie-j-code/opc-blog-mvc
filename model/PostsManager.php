<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/DbManager.php");

class PostsManager extends DbManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        // pas de paramètres extérieurs qui doivent intervenir dans la requête, donc pas besoin de requête préparée
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        // pourquoi on ne l'avait pas fait à l'époque ??? 
        $posts=$req->fetchAll();

        return $posts;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}