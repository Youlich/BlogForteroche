<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>
<?php
if (isset($_GET['success'])) {
    echo "Commentaire ajouté avec succès";
}
?>


    <p><a href="Blog.php">Retour à la liste des chapitres</a></p>

    <div class="post">
        <p>
            <img src="public/images/<?php echo $post->getImage();?>" />
        </p>
        <h3>
            <?= htmlspecialchars($post->getTitle()) ?>
        </h3>
        <p>
            <?= nl2br(htmlspecialchars($post->getContent())) ?>
        </p>


    </div>

    <h2>Commentaires</h2>

    <form action="Blog.php?action=addComment&amp;id=<?= $post->getId() ?>" method="post">
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
foreach ($comments as $comment)
{
    ?>
    <p><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?>

        <a href="Blog.php?action=Comment&numComm=<?=$comment->getId()?>">modifier</a>

    <p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>

    <?php
}
?>

<?php
foreach ($addcomment as $comment)
{
    ?>
    <p><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?>

        <a href="Blog.php?action=Comment&numComm=<?=$comment->getId()?>">modifier</a>

    <p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>

    <?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>