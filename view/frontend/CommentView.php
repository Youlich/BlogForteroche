<?php ob_start(); ?>

<h2>Commentaire</h2>


<br><br>


<form action="index.php?action=ModifComment&amp;numComm=<?= $comment->getId() ?>" method="post">

    <div>
        <input type="hidden" id="numComm" name="numComm" value="<?php echo $comment->getId()?>" />
    </div>
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?php echo $comment->getMembrePseudo()?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?php echo $comment->getComment()?></textarea>
    </div>
    <div>
        <input type="submit" class="btn btn-success btn-sm"/>
    </div>
    <br/><br/>

</form>


<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>

