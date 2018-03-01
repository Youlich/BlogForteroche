<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php'); ?>

<body id="top">

<header class="bg-primary text-white">
    <div class="container text-center">
        <br><br><br>
        <h1>Votre profil</h1>
        <br><br><br>
    </div>
</header>
<div align="center">
<p>
    <br><br><br>
    <h5>Votre pseudo : </h5><?php echo $_SESSION['pseudo']; ?>
    <br><br><br>
        <h5>Nombre de commentaires : </h5>
    <?php $nbComms ?>
    <br><br><br>
</p>

</div>

<?php require ('Footer.php'); ?>
</html>


