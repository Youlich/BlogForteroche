
<?php ob_start(); ?>

<h4><em><a href="index.php?action=listChapters">Retour à la liste des chapitres</a></em></h4>

<div class="post">
    <p>
        <img src="<?php echo $image?>" />
    </p>
    <h3><br>
        <?= htmlspecialchars($chapter->getTitle()) ?>
    </h3><br>
    <p>
        <?= nl2br(htmlspecialchars($chapter->getContent())) ?>
    </p>
</div>
<br><br>

<h4 id="nbcomments" ><span class="badge"><?= $nbComms ?> Commentaires</span></h4>
<br/>

<?php foreach ($comments as $comment)
{ ?>

        <h5><em><?= htmlspecialchars($comment->getMembrePseudo()) ?></em></h5>

        <?php echo $comment->getCommentDate() ?>
        <br>
        <p><h6>Votre commentaire : </h6><?= nl2br(htmlspecialchars($comment->getComment())) ?></p>

        <br/>
    <a href="index.php?action=signaled&amp;id=<?php echo $chapter->getId() ?>"><input type="button" value="Signaler"></a>

    <?php
} ?>

<div class="jumbotron">
    <h5>Laisser un commentaire</h5>
    <br>

    <?php if (isset($_SESSION['id'])) {?>
    <form action="index.php?action=addComment&amp;id=<?= $chapter->getId() ?>" method="post">
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

    <div> <?php if (isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];} ?></div>
        <?php unset($_SESSION['error']);?>

        <?php if (isset($_SESSION['success'])){?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];} ?></div>
    </div>
<?php } else {?>
    <h6><a href="index.php?action=inscripMembre" class="info"> Si vous n'avez pas de compte : Inscription ici </a><br/><br/>
        <a href="index.php?action=connectMembre" class="info"> Si vous avez déjà un compte : Connexion ici</a></br></h6>

<?php }?>

<?php $content = ob_get_clean(); ?>

<?php require('templateBlog.php'); ?>


<?php unset($_SESSION['success']);
unset($_SESSION['error']);?>
