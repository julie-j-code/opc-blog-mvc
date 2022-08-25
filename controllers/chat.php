<?php

// Chargement des classes
require_once('models/ChatManager.php');

function chatView()
{
    require('view/frontend/chatView.php');
   
}

function addMessage(){
    $chatManager = new ChatManager();

    // Logique d'appel à addMessage
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // On vérifie si l'utilisateur est connecté
        if (isset($_SESSION['user']['id'])) {
            // L'utilisateur est connecté
            // On récupère le message
            $donneesJson = file_get_contents('php://input');
            // log("ligne23", $donneesJson);

            // On convertit les données en objet PHP
            $donnees = json_decode($donneesJson);

            // On vérifie si on a un message
            if (isset($donnees->message) && !empty($donnees->message)) {
                $chatManager->addMessage($donnees );
            } else {
                // Pas de message
                http_response_code(400);
                echo json_encode(['message' => 'Le message est vide']);
            }
        } else {
            // Non connecté
            http_response_code(400);
            echo json_encode(['message' => 'Vous devez vous connecter']);
        }
    } else {
        // Mauvaise méthode
        http_response_code(405);
        echo json_encode(['message' => 'Mauvaise méthode']);
    }


    


}

// function chat()
// {
//     $chatManager = new ChatManager();
//     $chatManager->chat();

// }



// logique d'appel à charger les messages loadMessages
function loadMessages(){
    $chatManager = new ChatManager();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // On est en GET
    // On vérifie si on a reçu un id
    if (isset($_GET['lastId'])) {
        // On récupère l'id et on le nettoie
        $lastId = (int)strip_tags($_GET['lastId']);

        // On initialise le filtre
        $filtre = ($lastId > 0) ? " WHERE `messages`.`id` > $lastId" : '';

        $chatManager->loadMessages($filtre);
    }
} else {
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
}
