<?php $title = htmlspecialchars($post['title']); ?>
 
<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
 
<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
     
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>
 
<h2>Commentaires</h2>

 
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">

        <label for="author">Auteur</label><input type="text" id="author" name="author" />
        <label for="comment">Commentaire</label><textarea id="comment" name="comment" rows="5" cols="30"></textarea>
        <input type="submit" value="Ajouter" />

</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><br>
    <?= nl2br(htmlspecialchars($comment['comment'])) ?> (<a href="index.php?action=viewComment&amp;id=<?= $comment['id'] ?>">modifier</a>)</p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>