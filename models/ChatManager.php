<?php

require_once("models/DbManager.php");

class ChatManager extends DbManager
{ 

    public function chatView()
    {
        require('view/frontend/chatView.php');







    }

    // public function chat()
    // {
    //     $db = $this->dbConnect();
    // }


    // je récupère juste la logique de l'ajout de message
    // On vérifie la méthode


    public function addMessage($donnees)
    {
        $db = $this->dbConnect();

                    // On a un message
                    // On le stocke
                    // On se connecte, autrement dit c'est à ce stade qu'on devrait faire appel au manager!!!! Et seulement à ce stade....



                    // require_once('../inc/bdd.php');

                    // On écrit la requête
                    // $sql = 'INSERT INTO `messages`(`message`, `users_id`) VALUES (:message, :user);';

                    // On prépare la requête
                    $query = $db->prepare('INSERT INTO `messages`(`message`, `users_id`) VALUES (:message, :user);');

                    // On injecte les valeurs
                    $query->bindValue(':message', strip_tags($donnees->message));
                    $query->bindValue(':user', $_SESSION['user']['id']);

                    // On exécute en vérifiant si ça fonctionne
                    if ($query->execute()) {
                        http_response_code(201);
                        echo json_encode(['message' => 'Enregistrement effectué']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['message' => 'Une erreur est survenue']);
                    }

                    header("Location: index.php?action=chatView");
                
    }


    public function loadMessages($filtre)
    {
        $db = $this->dbConnect();


                // On se connecte, autrement dit c'est à ce stade qu'on devrait faire appel au manager!!!! Et seulement à ce stade....



                // On se connecte à la base
                // require_once('../inc/bdd.php');

                // On écrit la requête
                $sql = 'SELECT `messages`.`id`, `messages`.`message`, `messages`.`created_at`, `users`.`pseudo` FROM `messages` LEFT JOIN `users` ON `messages`.`users_id` = `users`.`id`' . $filtre . ' ORDER BY `messages`.`id` DESC LIMIT 5;';

                // On exécute la requête
                $query = $db->query($sql);

                // On récupère les données
                $messages = $query->fetchAll();

                // On encode en JSON
                $messagesJson = json_encode($messages);

                // On envoie
                echo $messagesJson;

                // header("Location: index.php?action=chatView");

    }




}
