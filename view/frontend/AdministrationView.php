<!DOCTYPE html>
<html lang="fr">

<?php require ('HeaderAdmin.php'); ?>

<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Administration du site</h1>
        </br></br></br>
    </div>
</header>
<body class="top">


<!-- Actions Section -->

<section class="portfolio" id="portfolio">
    <section class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Bienvenue <?php echo $_SESSION['login'] ?></h2>
        <hr class="star-dark mb-5">
        <h3 class="titre roman text-center">Que souhaitez vous gérer aujourd'hui ?</h3>
        <br/>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=1" class="chapter"><img class="img-fluid" src="public/images/publications.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=2" class="chapter"><img class="img-fluid" src="public/images/membres.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=3" class="chapter"><img class="img-fluid" src="public/images/commentaires.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=post&amp;id=4" class="chapter"><img class="img-fluid" src="public/images/profil.jpg" alt=""></a>
            </div>
        </div>
    </section>

</section>


    <?php require ('Footer.php'); ?>
</body>
</html>


