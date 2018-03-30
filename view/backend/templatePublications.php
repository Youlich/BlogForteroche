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
        <div> <a href="index.php?action=boutonaddbook">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau livre"></a><br/><br/></div>
     <?php if (!empty($_GET['boutonaddbook'])) {

           include ('AddbookView.php');

        } ?>
        <br/>

    <!-- Bouton ajout chapitre -->
    <div><a href="index.php?action=boutonaddchapter">
            <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau chapitre"></a><br/><br/></div>


        <!--choix du livre-->
        <?php include('BookSelectView.php');

     if (isset($_POST['bookSelect'])) { ?>
        <!-- Saisie des informations : titre, contenu et téléchargement image-->

         <?php include ('EditChapterView.php'); ?>

   <?php } ?>

        <br/>

    <!-- Bouton modification chapitre -->

    <a href="index.php?action=boutonmodifchapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a><br/><br/>
    <?php if (!empty($_GET['boutonmodifchapter'])){ ?>

    <!--Choix du chapitre à modifier -->
    <?php include('ChapterSelectView.php'); ?>

     <?php if (isset($_POST['chapterselect'])) { ?>

    <!-- Saisie des informations : titre, contenu et téléchargement image-->

     <?php include ('ModifChapterView.php'); ?>

    <?php } ?>
    <?php } ?>
    <br/>

    <!-- Bouton suppression chapitre -->
     <a href="index.php?action=boutondeletechapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a><br/><br/>
    <?php if (!empty($_GET['boutondeletechapter'])){ ?>

        <!--Choix du chapitre à supprimer -->
        <?php include('ChapterSelectView.php'); ?>

        <?php if (isset($_POST['chapterselect'])) { ?>

        <!--Formulaire de suppression-->
        <?php include ('DeleteChapterView.php'); ?>

    <?php } ?>
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
</body>
<?php include('view\frontend\Footer.php');?>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>