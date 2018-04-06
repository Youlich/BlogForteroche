<!DOCTYPE html>
<html lang="fr">

<?php require('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
    </div>
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
    <br/><br/><br/>

    <!--Bouton téléchargement de l'image-->
    <a href="index.php?action=boutonaddimage">
        <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Ajouter ou modifier une image"></a>
    <br/><br/>
    <!--Sélection du livre et du chapitre-->

    <form action="" method="post">
        <div class= "input-group" >
            <select name="bookSelect" class= "custom-select" id= "inputGroupSelect04" >
                <option name="bookSelect" selected > <?php echo $selectedbook ?></option>
                <?php foreach ($books as $book) { ?>
                    <option value="<?php echo $book->getId(); ?>"><?php echo $book->getTitle();  ?></option> <?php } ?>
            </select>
        </div>
        <br/>
        <div class= "input-group" >
            <select name="chapterselect" class= "custom-select" id= "inputGroupSelect04" >
                <option name="chapterselect" selected > <?php echo $selectedchapter ?></option>
                <?php foreach ($chapters as $chapter) { ?>
                    <option value="<?php echo $chapter->getId(); ?>"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
            </select>
        </div>
        <br/>
            <div align="center" >
                <input type="submit" class= "btn btn-outline-secondary" name="ok">
            </div>

    </form>
    <br/>

    <?php if (isset($_POST['bookSelect']) AND ($_POST['chapterselect'])) { ?>

        <!--Affichage de l'image existante-->

        <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo $image ?>" >

        <!--téléchargement de l'image-->
        <form action="index.php?action=upload" method="post" enctype="multipart/form-data" >
            <input type="text" value="<?php echo $selectedbook ?>">
            <input type="text" value="<?php echo $selectedchapter ?>">
        <div class="input-group">
            <label >Télécharger une image :&nbsp; </label>
            <input type="file" name="image" id="image">
            <br/><br/>
        </div>
            <div align="center">
                <input class="btn btn-success btn-md" type="submit" id="submit" name="ajout" value="Publier" />
            </div> <br/>
        </form>
            <br/>
    <?php } ?>

</div>

<div class="col-lg-4 mx-auto" align="center">
    <?php if (isset($_SESSION['error'])){ ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error'];} ?></div>
    <?php unset($_SESSION['error']);?></div>
<div class="col-lg-4 mx-auto" align="center">
    <?php if (isset($_SESSION['success'])){?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success'];} ?></div>
</div>
<br/>
<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
<br/>
<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
</body>
<?php include('view/frontend/Footer.php');?>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>

