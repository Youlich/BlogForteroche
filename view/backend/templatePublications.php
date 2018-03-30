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

        <!-- Partie ajout livre -->
        <div> <a href="index.php?action=selectbook">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau livre"></a><br/><br/></div>
        <?php if (!empty($_GET['selectbook'])) {
            $listbooks;
        } ?>
        <br/>

</div>

<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
<br/>
</body>
<?php require('Footer.php'); ?>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>