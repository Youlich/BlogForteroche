<!DOCTYPE html>
<html lang="fr">

<!--Header-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Site de Jean Forteroche</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="assets/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="assets/css/freelancer.min.css" rel="stylesheet">


</head>


<body id="top">
<!-- Navigation -->

<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a href="public/index.php?action=accueil"><img src="public/images/LOGO.png" width="200px"/>
            <a class="navbar-brand js-scroll-trigger" href="#top"></a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="public/index.php?action=accueil#portfolio">Blog</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="public/index.php?action=accueil#bibliographie">Bibliographie</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="public/index.php?action=accueil#contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a href="#" class="dropdown-toggle nav-link py-3 px-0 px-lg-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Espace membre <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['id'])) { ?>

                            <li><a class="dropdown-item" href="public/index.php?action=logoutmembre">Se déconnecter</a></li>
                            <li>
                                <a class="dropdown-item" href="public/index.php?action=profilmembre">Gérer mon compte
                                </a>
                            </li>


                            <?php } else { ?>

                            <li><a class="dropdown-item" href="public/index.php?action=loginmembre">Se connecter</a></li>
                            <li><a class="dropdown-item" href="public/index.php?action=charte">S'inscrire</a></li>
                            <?php } ?>


                        </ul>
                    </li>
                </ul>
            </div>
    </div>
</nav>

</body>

<!-- Contenu -->
<div style="padding-top: 20%; padding-bottom: 10%; text-align: center;">
<h1>Erreur 404</h1>
Votre page demandée est introuvable.

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
            <small>Copyright © 2018 Jean FORTEROCHE - Billet simple pour l'Alaska - Projet n° 3 - CDP dev - <a href="public/index.php?action=mentionslegales">Mentions légales</a> -
                <a href="public/index.php?action=loginadmin">Administration</a></small>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="assets/js/jqBootstrapValidation.js"></script>
<script src="assets/js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="assets/js/freelancer.min.js"></script>
<script src="assets/js/main.js"></script>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

</html>