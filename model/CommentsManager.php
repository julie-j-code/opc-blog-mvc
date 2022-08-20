<?php

namespace Model;

require_once("model/DbManager.php");

class CommentsManager extends DbManager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        // pourquoi on ne l'avait pas fait à l'époque - et pourquoi la correction aujourd'hui disponible en ligne n'utilise pas fetchAll - je ne comprends pas. Quoi qu'il en soit, on change ça... 
        $comments=$req->fetchAll();

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
}