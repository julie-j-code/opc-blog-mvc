<?php

// Chargement des classes
require_once('./models/PostsManager.php');
require_once('./models/CommentsManager.php');


function listPosts()
{
    $postsManager = new PostsManager();
    $posts = $postsManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postsManager = new PostsManager();
    $commentsManager = new CommentsManager();

    $post = $postsManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');

}

function addPost($title, $content)
{
    $postsManager = new PostsManager();
    $newPost = $postsManager->addPost($title, $content);

}

function editPostView()
{
    $postsManager = new PostsManager();
    $post = $postsManager->getPost($_GET['id']);

    require('view/frontend/editPostView.php');
    return $post;
}

function editPost($title, $content, $id)
{

    $postsManager = new PostsManager();
    $affectedLines=$postsManager->editPost($title, $content, $id);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        // redirection vers le  post mis à jour
        header('Location: index.php?action=post&id=' . $id);
    }

}
