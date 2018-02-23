<!DOCTYPE html>
<html lang="fr">
<?php include ('head.php'); ?>
<?php require('../../model/AuthAdminManager.php'); ?>
<body id="top">
<?php require('Header.php'); ?>
<div class = "corps" align="center">

    <h1>Connexion Admin</h1>
    <br /> <br />

    <?php require('AuthView.php'); ?>


</div>
<?php include('Footer.php');?>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
</body>