<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
</header>

<body class="top">
<br/><br/>

<div class="container">

    <!-- Bouton ajout livre -->
    <a href="index.php?action=boutonaddbook">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau livre"></a>
    <br/><br/><br/>

    <!-- Bouton ajout chapitre -->
    <a href="index.php?action=boutonaddchapter">
            <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau chapitre"></a>
        <br/><br/><br/>

    <!-- Bouton modification chapitre -->

    <a href="index.php?action=boutonmodifchapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a>
    <br/><br/><br/>

    <!-- Bouton suppression chapitre -->
    <a href="index.php?action=boutondeletechapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a>
    <br/><br/>

    <!--Choix du chapitre à modifier -->
    <form action="" method="post">
        <div class= "input-group">
            <select name="chapterselect" class= "custom-select" id= "inputGroupSelect04" >
                <option selected > <?php echo $selectedchapter ?></option>
                <?php foreach ($chapters as $chapter) { ?>
                    <option value="<?php echo $chapter->getId(); ?>"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
            </select>
            <div class= "input-group-append" >
                <input type="submit" class= "btn btn-outline-secondary" name="okchapter"  >
            </div> <br/><br/>
        </div>
    </form>

    <?php if (isset($chapterselect)): ?>

    <!--Formulaire de suppression-->
    <form action="index.php?action=deletechapter" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="chapterselect" value="<?php echo $chapterselect->getId(); ?>">
        <br/>
        <div class="input-group" >
            <label for="content">Contenu : </label>
            <textarea class="content" id="content" name="content" rows="15"> <?php echo $chapterselect->getContent(); ?> </textarea>
        </div> <br/><br/>
        <div>
            <h6>Mon image :</h6>
            <br/>
            <img src="<?php echo $image ?>" style="width: 15%;">
            <?php echo $message ?>
        </div>
        <br/>
        <br/><br/>
        <div class="text-center">
            <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Supprimer" />
        </div>
    </form>

<?php endif; ?>
    <br/><br/>



<br/>
<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
<br/>

</div>
</body>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>