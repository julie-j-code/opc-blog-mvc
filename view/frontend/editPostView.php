<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<h2>Edition du billet <?= $_GET['id'] ?></h2>


<div class="news">

    <form action="index.php?action=editPost" method="post">
        <div>
            <label for="updatedTitle">Titre</label><br />
            <input type="text" id="updatedTitle" name="updatedTitle" value="<?= $post['title'] ?>" />
        </div>
        <div>
            <label for="updatedContent">Contenu</label><br />
            <textarea id="updatedContent" rows="10" cols="100" name="updatedContent"><?php echo $post['content'] ?></textarea>
        </div>
        <input class="hidden" type="text" id="id" name="id" value="<?= $post['id'] ?>" />
        <div>
            <input type="submit" name="editPost" />
        </div>
    </form>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('baseLayout.php'); ?>