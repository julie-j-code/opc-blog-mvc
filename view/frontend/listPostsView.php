<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h2>Derniers billets du blog :</h2>


<?php
foreach ($posts as $post) {
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?> - id <?= $post['id'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a>
        </p>
        <?= htmlspecialchars($_SESSION['user']['pseudo']) ?>
    </div>

<?php
}

?>

<div class="news">
    <h2>Ajouter un Post</h2>

    <form action="index.php?action=addPost" method="post">
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" />
        </div>
        <div>
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content"></textarea>
        </div>

        <div>
            <input type="submit" name="newPost" />
        </div>
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>