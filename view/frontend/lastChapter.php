<header class="bg-primary text-white text-center">
    <br><br><br>
    <h1>Billet simple pour l'Alaska</h1>
    <br><br><br>
</header>

<body>
<br><br>

<em><h5 class="link text-center"><a href="index.php?action=listchapters">Retour à la liste des chapitres</a></em> </h5>
<div class="contain">
<div class="post">
    <p>
        <img src="<?php echo $image?>" />
    </p>
    <h3><br>
        <?= htmlspecialchars($lastchapter->getTitle()) ?>
    </h3><br>
    <p>
        <?= htmlspecialchars($lastchapter->getContent()) ?>
    </p>
</div>
<br><br>

<h4 id="nbcomments" ><span class="badge"><?= $nbComms ?> Commentaires</span></h4>
<br/>

<?php foreach ($comments as $comment)
{ ?>
<div>
    <h5><em><?= htmlspecialchars($comment->getMembrePseudo()) ?></em></h5>

    <?php echo htmlspecialchars($comment->getCommentDate()) ?>
    <br>
    <p><h6>Votre commentaire : </h6><?= htmlspecialchars($comment->getComment()) ?></p>

    <br/>
    <a href="index.php?action=signaled&amp;id=<?php echo $lastchapter->getId() ?>"><input type="button" value="Signaler"></a>
    </div>
    <br/>
    <?php
} ?>

<div class="jumbotron">
    <h5>Laisser un commentaire</h5>
    <br>

    <?php if (isset($_SESSION['id'])) {?>
    <form action="index.php?action=addcomment&amp;id=<?= $lastchapter->getId() ?>" method="post">
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

<?php } else {?>
    <h6><a href="index.php?action=inscription" class="info"> Si vous n'avez pas de compte : Inscription ici </a><br/><br/>
        <a href="index.php?action=loginmembre" class="info"> Si vous avez déjà un compte : Connexion ici</a></br></h6>

<?php }


unset($_SESSION['success']);
unset($_SESSION['error']);?>
</div>
</body>