<?php ob_start(); ?>

<h2>Commentaire</h2>

<?php
if (isset($_GET['success'])) {
    echo "Commentaire modifié avec succès";
}
?>
<br></br>


<form action="index.php?action=ModifComment&amp;numComm=<?= $comment->getId() ?>" method="post">

    <div>

        <input type="hidden" id="numComm" name="numComm" value="<?php echo $comment->getId()?>" />
    </div>
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?php echo $comment->getAuthor()?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?php echo $comment->getComment()?></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
    <div>
        <p>
            <a href="index.php?action=post&id=<?=$comment->getPostId(); ?>">Retour vers la liste des commentaires du billet</a>
        </p>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>

