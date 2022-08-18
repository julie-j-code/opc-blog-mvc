<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Vous enregistrer</h1>

<form action="index.php?action=register" method="post">
        <div>
            <label for="author">Pseudo</label><br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div>
            <label for="email">Email</label><br />
            <input type="email" id="email" name="email" />
        </div>
        <div>
            <label for="password">Password</label><br />            
            <input type="text" id="password" name="password" />
        </div>
        <div>
        <input type="submit" />
        </div>
    </form>

    <?php if (isset ($_GET["error"])){
        $error = $_GET["error"];
        echo $error;
} else {$error = "";} ?>

<?php $content = ob_get_clean(); ?>

<?php require('baseLayout.php'); ?>