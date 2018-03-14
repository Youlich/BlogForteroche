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
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#actualités">Bibliographie</a>
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
                                    <a class="dropdown-item" href="index.php?action=profilMembre">Gérer mon compte
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

                if (isset($_SESSION['id'])){
                    if(($_SESSION['id']) != '2')
                    {
                    echo $_SESSION['pseudo'] . ' !';
                }
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
                    <div style=" height:400px;">
                        <div style="position:absolute;z-index:1">
                            <a href="index.php?action=post&amp;id=1"><img src="public/images/reve.jpg" alt="rêve" class="img-fluid"></a>
                        </div>
                        <div style="text-align:center;position:absolute;top:100px; width:550px; height:400px; z-index:2;font-size:150%">
                            <a href="index.php?action=post&amp;id=1"><p style="color:white;font-weight: bold;">Chapitre 1 :<br/>Quand le rêve devient réalité</p></a>
                        </div>
                    </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                        <div style="height:400px;">
                            <div style="position:absolute;z-index:1">
                                <a href="index.php?action=post&amp;id=2"><img class="img-fluid" src="public/images/decouverte.jpg" alt="découverte"/></a>
                            </div>
                            <div style="text-align:center;position:absolute;top:100px; width:550px; height:400px; z-index:2;font-size:150%">
                                <a href="index.php?action=post&amp;id=2"><p style="text-align:center;color:white;font-weight: bold;">Chapitre 2 :<br/>Découverte de l'Alaska</p></a>
                            </div>
                        </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                        <div style="height:400px">
                            <div style="position:absolute;z-index:1;">
                                <a href="index.php?action=post&amp;id=3"><img class="img-fluid" src="public/images/etudes.jpg" alt="études"/></a>
                            </div>
                            <div style="text-align:center;position:absolute;top:100px; width:550px; height:400px; z-index:2;font-size:150%">
                                <a href="index.php?action=post&amp;id=3"><p style="text-align:center;color:white;font-weight: bold;">Chapitre 3 :<br/> Les études en Alaska</p></a>
                            </div>
                        </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <div style="height:400px">
                        <div style="position:absolute;z-index:1;">
                            <a href="index.php?action=post&amp;id=4"><img class="img-fluid" src="public/images/glacier.jpg" alt="glacier"/></a>
                        </div>
                        <div style="text-align:center;position:absolute;top:100px; width:550px; height:400px; z-index:2;font-size:150%">
                            <a href="index.php?action=post&amp;id=4"><p style="text-align:center;color:white;font-weight: bold;">Chapitre 4 :<br/> Expérience unique</p></a>
                        </div>
                    </div>
            </div>
        </div>
    </section>


    <!-- Mes actualités Section -->

    <section class="bg-primary text-white mb-0" id="actualités">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Bibliographie</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-md-3 col-lg-3 ml-auto">
                    <p class="lead">Billet simple pour l'Alaska</p>
                </div>
                <div class="col-md-3 col-lg-3 mr-auto">
                    <p class="lead">A la poursuite du chat noir</p>
                </div>
                <div class="col-md-3 col-lg-3 mr-auto">
                    <p class="lead">Vipère</p>
                </div>
                <div class="col-md-3 col-lg-3 mr-auto">
                    <p class="lead">La chasse aux trésors</p>
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
                    <?php if(array_key_exists('success',$_SESSION)): ?>
                        <div class="alert alert-success">
                            Votre email à bien été transmis !
                        </div>
                    <?php endif; ?>
                    <?php if(array_key_exists('errors',$_SESSION)): ?>
                        <div class="alert alert-danger">
                            <?= implode('<br>', $_SESSION['errors']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?action=contact" method="post" name="contactform">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nom</label>
                                <input class="form-control" name='name' type="text" placeholder="Nom" value="<?php isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : ''; ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Adresse mail</label>
                                <input class="form-control" name='email' type="text" placeholder="Adresse mail" value="<?php isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : ''; ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Message</label>
                                <textarea class="form-control" name='message' rows="5" placeholder="Message" <?php isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : ''; ?>></textarea>
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

<?php

include ('view/frontend/footer.php');

unset($_SESSION['inputs']);
unset($_SESSION['errors']);
unset($_SESSION['success']);
?>