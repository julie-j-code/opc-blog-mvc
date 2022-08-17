<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h2><a href="index.php">Retour à la liste des billets</a></h2>

<h2>Edition de mon profil</h2>


    <p><strong><?= htmlspecialchars($comment['author']) ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>


<?php $content = ob_get_clean(); ?>

<?php require('baseLayout.php'); ?>

<!-- ... -->

<h2>Modifier Commentaires</h2>

<form action="index.php?action=updateComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<!-- ... -->


