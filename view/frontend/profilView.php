<?php $title = htmlspecialchars($_SESSION['user']['pseudo']); ?>

<?php ob_start(); ?>

<div class="news">

    <h1>Informations du profil</h1>
    <h2><a href="index.php">Retour à la liste des billets</a></h2>



    <p><strong>Mon pseudo : <?= htmlspecialchars($_SESSION['user']['pseudo']) ?></p>
    <p>Mon Email : <?= nl2br(htmlspecialchars($_SESSION['user']['email'])) ?></p>

</div>


<!-- ... -->

<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>