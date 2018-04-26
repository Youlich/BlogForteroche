<!DOCTYPE html>
<html lang="fr">

<!-- Header -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Site de Jean Forteroche</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo CSS; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>style.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?php echo CSS; ?>font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo MP; ?>magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo CSS; ?>freelancer.min.css" rel="stylesheet">

    <script src="<?php echo TINYMCE; ?>tinymce.min.js"></script>
    <script>tinymce.init({ selector : 'textarea',elements : 'content',entity_encoding: "raw", forced_root_block : false, force_br_newlines : true, falsebranding : false, valid_elements : "em/i,strike,u,strong/b,div[align],br,#p[align],-ol[type|compact],-ul[type|compact],-li"});
    </script>
</head>


<body id="top">
<!-- Barre des menus -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <img src="<?php echo IMAGES; ?>\LOGO.png" width="200px"/>
        <a class="navbar-brand js-scroll-trigger" href="#top"></a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                </li>
                <li class="nav-item mx-0 mx-lg-1">

                </li>
                <li class="nav-item mx-0 mx-lg-1">

                </li>
                <li class="nav-item dropdown mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logoutadmin">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>

<!-- Contenu -->


    <?= $content; ?>

<<!-- Errors -->
<div class="container">
    <div class="col-lg-4 mx-auto">
        <?php if (isset($error)){ ?>
        <div align="center" class="alert alert-danger">
            <?php echo $error;} ?></div>
        <?php if (isset($success)){?>
        <div align="center" class="alert alert-success">
            <?php echo $success;} ?></div>
    </div>
</div>

<!-- Footer -->
<footer class="footer text-center">

    <div>

        <h4 class="text-uppercase mb-4">Me rejoindre sur</h4>
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                    <i class="fa fa-fw fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                    <i class="fa fa-fw fa-google-plus"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                    <i class="fa fa-fw fa-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                    <i class="fa fa-fw fa-linkedin"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                    <i class="fa fa-fw fa-dribbble"></i>
                </a>
            </li>
        </ul>
    </div>

</footer>


<div class="copyright">
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright © 2018 Jean FORTEROCHE - Billet simple pour l'Alaska - Projet n° 3 - CDP dev - <a href="index.php?action=mentionslegales">Mentions légales</a> -
                <a href="index.php?action=loginadmin">Administration</a></small>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo JS; ?>jquery.min.js"></script>
<script src="<?php echo JS; ?>bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo JS; ?>jquery.easing.min.js"></script>
<script src="<?php echo MP; ?>jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo JS; ?>jqBootstrapValidation.js"></script>
<script src="<?php echo JS; ?>contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="<?php echo JS; ?>freelancer.min.js"></script>
<script src="<?php echo JS; ?>main.js"></script>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>