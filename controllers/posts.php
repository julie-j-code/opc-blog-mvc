<?php

// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');

function listPosts()
{
    $postsManager = new \OpenClassrooms\Blog\Model\PostsManager();
    $posts = $postsManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postsManager = new \OpenClassrooms\Blog\Model\PostsManager();
    $commentsManager = new \OpenClassrooms\Blog\Model\CommentsManager();

    $post = $postsManager->getPost($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

