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

    // require('view/frontend/postView.php');
}

