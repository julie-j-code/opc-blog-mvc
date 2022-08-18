<?php $title = htmlspecialchars($_SESSION['user']['pseudo']); ?>

<?php ob_start(); ?>

<div class="news">

    <h1>Informations du profil</h1>
    <h2><a href="index.php">Retour à la liste des billets</a></h2>



    <p><strong>Mon pseudo : <?= htmlspecialchars($_SESSION['user']['pseudo']) ?></p>
    <p>Mon Email : <?= nl2br(htmlspecialchars($_SESSION['user']['email'])) ?></p>

</div>


<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>

<!-- ... -->

<!-- <h2>Modifier Mes informations</h2>

<form action="index.php?action=profil&amp;id=<?= $_SESSION['user']['id'] ?>" method="post">
    <div>
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" />
    </div>
    <div>
        <label for="email">Email</label><br />
        <input type="text" id="email" name="email" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form> -->

<!-- ... -->