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
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a>
        </p>
    </div>
<?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('baseLayout.php'); ?>