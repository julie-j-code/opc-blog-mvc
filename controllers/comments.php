<?php

// Chargement des classes
// require_once('model/PostManager.php');
require_once('model/CommentsManager.php');

function addComment($postId, $author, $comment)
{
    $commentsManager = new \OpenClassrooms\Blog\Model\CommentsManager();

    $affectedLines = $commentsManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}