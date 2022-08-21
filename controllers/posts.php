<?php

// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');
require_once('model/UsersManager.php');

function listPosts()
{
    $postsManager = new Model\PostsManager();
    $posts = $postsManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postsManager = new Model\PostsManager();
    $commentsManager = new Model\CommentsManager();

    $post = $postsManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');

}

function addPost($title, $content)
{
    $postsManager = new Model\PostsManager();
    $newPost = $postsManager->addPost($title, $content);

}

function editPostView()
{
    $postsManager = new Model\PostsManager();
    $post = $postsManager->getPost($_GET['id']);

    require('view/frontend/editPostView.php');
    return $post;
}

function editPost($title, $content, $id)
{

    $postsManager = new Model\PostsManager();
    $affectedLines=$postsManager->editPost($title, $content, $id);

    // pas normal ici de ne pas avoir le CSS sans ça. A revoir
    // header('Location: index.php');

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        // redirection vers le  post mis à jour
        header('Location: index.php?action=post&id=' . $id);
    }

}
