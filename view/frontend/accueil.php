<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Site de Jean Forteroche</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">

</head>

<body id="top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a href="#masthead"><img src="public/images/LOGO.png" width="200px"/>
            <a class="navbar-brand js-scroll-trigger" href="#top"></a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Blog</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#actualités">Mes Actualités</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="dropdown">Espace membre</a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['id'])) { ?>

                                <li><a class="dropdown-item" href="index.php?action=deconnectMembre">Se déconnecter</a></li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=accesSuppMembre">
                                        Supprimer mon compte
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=profilMembre">
                                        Votre profil
                                    </a>
                                </li>

                            <?php } else { ?>

                                <li><a class="dropdown-item" href="index.php?action=connectMembre">Se connecter</a></li>
                                <li><a class="dropdown-item" href="index.php?action=inscripMembre">S'inscrire</a></li>
                            <?php } ?>


                        </ul>
                    </li>
                </ul>
            </div>
    </div>
</nav>


<!-- Header -->
<header class="masthead bg-primary text-white text-justify" id="masthead">
    <div class="container">
        <h2 class="text-center text-uppercase text-white">Bienvenue sur mon site <?php
            if(isset($_SESSION['id']))
            {
                echo $_SESSION['pseudo'] . ' !';
            }
            ?>
        </h2>

        <hr class="star-light mb-5">
        <br/>
        <p class="photo">
            <img class="img-fluid mb-5 d-block mx-auto" src="public/images/forteroche.jpg" alt="Jean Forteroche" >
        </p>
        <p class="message">
            Je m'appelle Jean Forteroche, auteur de Roman mon métier, ma passion.<br/>
            Je vis en Bretagne, dont je suis originaire.<br/>
            Vous trouverez sur ce site :
        <ol>
            <li>- mon Blog avec les chapitres de mon nouveau roman. N'hésitez pas à donner votre avis.</li>
            <li>- mes actualités : sur mes projets, scéances de dédicaces...</li>
            <li>- une page contact si vous souhaitez me poser des questions complémentaires.</li><br/><br/>
            <li><strong>  Bonne visite </strong></li>
        </ol>
        </p>
    </div>
</header>


<!-- Chapters Section -->

<section class="portfolio" id="portfolio">
    <section class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Blog</h2>
        <hr class="star-dark mb-5">
        <h3 class="titre roman text-center">Billet simple pour l'Alaska</h3>
        <br/>
        <em><h5 class="link text-center"><a href="index.php?action=listPosts&amp">Voir tous les chapitres</h5></em>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=1" class="chapter"><img class="img-fluid" src="public/images/reve.jpg" alt="">Chapitre 1 : Quand le rêve devient réalité</a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=2" class="chapter"><img class="img-fluid" src="public/images/decouverte.jpg" alt="">Chapitre 2 : découverte de l'Alaska</a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=3" class="chapter"><img class="img-fluid" src="public/images/etudes.jpg" alt="">Chapitre 3 : les études en Alaska</a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=4" class="chapter"><img class="img-fluid" src="public/images/glacier.jpg" alt="">Chapitre 4 : expérience unique</a>
            </div>
        </div>
    </section>


    <!-- Mes actualités Section -->

    <section class="bg-primary text-white mb-0" id="actualités">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Mes actualités</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Actu1</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Actu2</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Me contacter</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nom</label>
                                <input class="form-control" id="name" type="text" placeholder="Nom" required="required" data-validation-required-message="Rentrez votre nom.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Adresse mail</label>
                                <input class="form-control" id="email" type="email" placeholder="Adresse mail" required="required" data-validation-required-message="Rentrez votre adresse mail.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Saisissez votre message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Bibliographie</h4>
                <p class="lead mb-0 text-center">Voir ma
                    </br>
                    <a href="http://startbootstrap.com">Bibliographie</a></p>
            </div>
            <div class="col-md-4 mb-5 mb-lg-0">
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
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Newsletter</h4>
                <p class="lead mb-0">S'inscrire à ma<br/>
                    <a href="http://startbootstrap.com">Newsletter</a></p>
            </div>
        </div>
    </div>
</footer>


<div class="copyright">
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright © 2018 Jean FORTEROCHE - Billet simple pour l'Alaska - Projet n° 3 - CDP dev - <a href="index.php?action=mentionslegales">Mentions légales</a> -
                <a href="index.php?action=connectAdmin">Administration</a></small>
        </div>
    </div>
</div>


<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

</body>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="js/freelancer.min.js"></script>
</html>