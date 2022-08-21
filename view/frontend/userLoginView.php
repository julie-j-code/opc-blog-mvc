<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Vous indentifier</h1>
<div class="news">
    <form action="index.php?action=login" method="post">
        <div>
            <label for="pseudo">Pseudo</label><br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div>
            <label for="password">Password</label><br />
            <input type="text" id="password" name="password" />
        </div>
        <div>
            <input type="submit" name="login" />
        </div>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('baseLayout.php'); ?>