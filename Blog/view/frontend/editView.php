<?php $title = 'Modifier un commentaire' ?>
 
<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour au billet</a></p>
 
 
 
<h2>Modifier un commentaire</h2>
 
<form id="edit" action="index.php?action=editComment&amp;id=<?= $comment['id'] ?>" method="post">
        <label for="author">Auteur : <?= $comment['author'] ?><br>
        <label for="comment" required>Commentaire</label>
        <textarea id="comment" name="comment" rows="5" cols="30"><?= $comment['comment'] ?></textarea>
        <input type="submit" value="Modifier" />
</form>
 
 
<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>

