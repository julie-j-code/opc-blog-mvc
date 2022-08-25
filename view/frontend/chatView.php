<?php $title = 'Chat Utilisateurs'; ?>

<?php ob_start(); ?>

<h1> <?= $title ?></h1>
<div class="news">

    <?php
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        // Ici, l'utilisateur est connecté
    ?>
        <h2>Bonjour <?= $_SESSION['user']['pseudo'] ?> </h2>
    <?php
    } else {
        // Ici l'utilisateur n'est pas connecté
    ?>
        <a class="btn btn-primary mr-2" href="index.php?action=login">Connexion</a> <a class="btn btn-primary" href="index.php?action=register">Inscription</a>
    <?php
    }
    ?>

    <div id="discussion">
    </div>

    <div class="saisie">

        <input type="text" id="texte" placeholder="Entrez votre texte">
        <input type="submit" id="valid" placeholder="Valider">


    </div>

</div>


<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>