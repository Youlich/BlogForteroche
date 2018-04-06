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
    <br/><br/>
    <form action="index.php?action=addbook" method="post" >
        <div class= "input-group" >
            <label for="titre">Nouveau titre de livre : </label>
            <input type="text" name="titrelivre" id="titrelivre" style="width: 200%;"/>
        </div>
        <br/>
        <div class="text-center">
            <input class="btn btn-success btn-md" type="submit" id="submit" name="submit" value="Publier" />
        </div>
    </form>
    <br/>

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