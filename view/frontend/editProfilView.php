<?php $title = htmlspecialchars($_SESSION['user']['pseudo']); ?>

<?php ob_start(); ?>

<!-- ... -->

<h2>Modifier Mes informations</h2>

<form action="index.php?action=editUser" method="post">
    <div>
        <label for="updatedPseudo">Pseudo</label><br />
        <input type="text" id="updatedPseudo" name="updatedPseudo" />
    </div>
    <div>
        <label for="updatedEmail">Email</label><br />
        <input type="text" id="updatedEmail" name="updatedEmail" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<!-- ... -->

<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>