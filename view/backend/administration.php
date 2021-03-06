<header class="bg-primary text-white text-center">

        <br/><br/>
        <h1>Administration du site</h1>
        <br/><br/><br/>

</header>



<!-- Actions Section -->

<section class="portfolio" id="portfolio">
    <section class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Bienvenue <?php echo $login ?></h2>
        <hr class="star-dark mb-5">
        <h3 class="titre roman text-center">Que souhaitez vous gérer aujourd'hui ?</h3>
        <br/>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=publier" class="chapter"><img class="img-fluid" src="<?php echo IMAGES; ?>publications.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=listmembres" class="chapter"><img class="img-fluid" src="<?php echo IMAGES; ?>membres.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=listcomments" class="chapter"><img class="img-fluid" src="<?php echo IMAGES; ?>commentaires.jpg" alt=""></a>
            </div>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <a href="index.php?action=profiladmin" class="chapter"><img class="img-fluid" src="<?php echo IMAGES; ?>profil.jpg" alt=""></a>
            </div>
        </div>
    </section>

</section>

