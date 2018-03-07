<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>
<?php
if (isset($_GET['success'])) {
    echo "Commentaire ajouté avec succès";
}
?>


    <h4><a href="index.php?action=listPosts">Retour à la liste des chapitres</a></h4>

    <div class="post">
        <p>
            <img src="public/images/<?php echo $post->getImage();?>" />
        </p>
        <h3><br>
            <?= htmlspecialchars($post->getTitle()) ?>
        </h3><br>
        <p>
            <?= nl2br(htmlspecialchars($post->getContent())) ?>
        </p>
    </div>
    <br><br>

    <h4><span class="badge"><?= $nbComms ?> Commentaires</span></h4>

    <br>
<?php

foreach ($comments as $comment)
{
    ?>

    <h5><em><?= htmlspecialchars($comment->getAuthor()) ?></em></h5>

        <?= $comment->getCommentDate() ?><br/>
        <br>
    <p><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>
    <br>
    <a href="index.php?action=Comment&numComm=<?=$comment->getId()?>"><button type="button" class="btn btn-success btn-sm">Modifier</button></a>

    <?php
} ?>

    <div class="jumbotron">
        <h5>Laisser un commentaire</h5>
        <br>
        <?php if (isset($_SESSION['id'])) {?>
    <form action="index.php?action=addComment&amp;id=<?= $post->getId() ?>" method="post">
        <div>
            <?php
                echo $_SESSION['pseudo']; ?>
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer" />
        </div>
    </form>
    </div>
    <?php
} else {?>
    <h6><a href="index.php?action=inscripMembre" class="info"> Si vous n'avez pas de compte : Inscription ici </a><br/><br/>
        <a href="index.php?action=connectMembre" class="info"> Si vous avez déjà un compte : Connexion ici</a></br></h6>


<?php }?>

<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>