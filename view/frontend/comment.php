    <header class="bg-primary text-white text-center">
        </br></br></br>
        <h1>Commentaire</h1>
        </br></br>
    </header>
    </br></br>

<body>
<div class="container" >

<form action="index.php?action=modifcomment&numComm=<?= $comment->getId() ?>" method="post">

        <div class="form-group">
        <label for="nummComm"></label>
        <input type="hidden" id="numComm" name="numComm" value="<?php echo $comment->getId()?>" />
        </div>
        <div class="form-group">
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" value="<?php echo $comment->getMembrePseudo()?>" />
        </div>
        <div class="form-group">
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?php echo htmlspecialchars($comment->getComment())?></textarea>
        </div>
        <div align="center">
        <input type="submit" class="btn btn-success btn-sm"/>
        </div>

    <br/><br/>

</form>

</div>
</body>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>