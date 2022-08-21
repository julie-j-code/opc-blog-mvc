<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h2><a href="index.php">Retour à la liste des billets</a></h2>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>
<!-- c'est pour le fun. puisqu'il n'était pas prévu d'auteur ce qui n'est pas cohérent et empêcherait l'édition par quiconque d'autre que l'admin du blog -->
<h3><a href="index.php?action=editPost&amp;id=<?= $post['id'] ?>">Editer le billet <?= $post['id'] ?></a></h3>

<div class="comments">

    <h2>Commentaires</h2>

    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
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

    <?php
    foreach ($comments as $comment) {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
    }
    ?>
    <?php $content = ob_get_clean(); ?>
</div>



<?php require('baseLayout.php'); ?>