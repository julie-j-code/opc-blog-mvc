<?php

require_once("models/DbManager.php");

class PostsManager extends DbManager
{    
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        $posts = $req->fetchAll();
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

    public function addPost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $req->execute(array($title, $content));
        header('Location: index.php');
        $req->fetch();
    }

    public function editPost($title, $content, $id){
        $db = $this->dbConnect();
        $req = $db->prepare(
            'UPDATE posts SET title = ?, content = ? WHERE id = ?'
        );
        $affectedLines = $req->execute([$title, $content, $id]);
        return $affectedLines;

    }
}
