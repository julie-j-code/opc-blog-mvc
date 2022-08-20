<?php $title = htmlspecialchars($_SESSION['user']['pseudo']); ?>

<?php ob_start(); ?>

<!-- ... -->

<h2>Modifier Mes informations</h2>

<?php
// echo var_dump(isset($_POST['submit'])) ?>

<form action="index.php?action=editUser" method="post">
    <div>
        <label for="updatedPseudo">Pseudo</label><br />
        <input type="text" id="updatedPseudo" name="updatedPseudo"  value="<?php echo $_SESSION["user"]["pseudo"] ?>" />
    </div>
    <div>
        <label for="updatedEmail">Email</label><br />
        <input type="text" id="updatedEmail" name="updatedEmail" value="<?php echo $_SESSION["user"]["email"] ?>" />
    </div>
    <div>
        <input type="submit" name="submit" />
    </div>
</form>

<?php if (isset ($_GET["error"])){
        $error = $_GET["error"];
        echo $error;
} else {$error = "";} ?>

<!-- ... -->

<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>