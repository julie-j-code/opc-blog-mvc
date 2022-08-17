<?php $title = htmlspecialchars($_SESSION['user']['pseudo']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h2><a href="index.php">Retour à la liste des billets</a></h2>

<h2>Edition de mon profil</h2>


<p><strong><?= htmlspecialchars($user['pseudo']) ?></p>
<p><?= nl2br(htmlspecialchars($user['email'])) ?></p>


<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>

<!-- ... -->

<h2>Modifier Mes informations</h2>

<form action="index.php?action=updateUser&amp;id=<?= $user['id'] ?>" method="post">
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
</form>

<!-- ... -->