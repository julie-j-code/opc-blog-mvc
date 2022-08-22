<?php

// Chargement des classes
require_once('models/PostsManager.php');
require_once('models/CommentsManager.php');

function addComment($postId, $author, $comment)
{
    $commentsManager = new CommentsManager;

    $affectedLines = $commentsManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}