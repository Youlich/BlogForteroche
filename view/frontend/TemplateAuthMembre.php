<!DOCTYPE html>
<html lang="fr">


<head>
    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/style.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../../css/freelancer.min.css" rel="stylesheet">
</head>
<?php require('../../model/AuthMembreManager.php'); ?>
<body id="top">
<?php require('Header.php'); ?>
<div class = "corps" align="center">

    <h1>Connexion Membre</h1>
    <br /> <br />

    <?php require('AuthView.php'); ?>

    <a href="">Créer votre compte ici</a>
</div>
<?php include('Footer.php');?>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
</body>