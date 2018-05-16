
<section class="bg-primary text-white mb-0" id="masthead">
        <section class="container">
        <h2 class="text-uppercase text-center  text-white" style="font-size: xx-large;">Bienvenue sur mon site

               <?php if ($sessionok) {
                    if(($sessionId) != '2')
                    {
                    echo $sessionPseudo . ' !';
                }
            }
            ?>
        </h2>
        <hr class="star-light mb-5">
        <br/>
        <p class="photo">
            <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo $admin->getPhoto(); ?>" alt="Jean Forteroche" >
        </p>
        <p class="message">
            <?php echo $admin->getMessage(); ?>
        </p>

    </section>
    <br/><br/>
</section>


<!-- Chapters Section -->

<section class="portfolio" id="portfolio">
    <section class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Blog</h2>
        <hr class="star-dark mb-5">
        <h3 class="titre roman text-center">Billet simple pour l'Alaska</h3>
        <br/>
        <em><h5 class="link text-center"><a href="index.php?action=listchapters">Voir tous les chapitres</h5></em>
        <br/>
        <em><h5 class="link text-center"><a href="index.php?action=lastchapter">Voir mon dernier chapitre</h5></em>

        <div class="row">
            <?php
            foreach ($chapters as $chapter)
            {
                ?>
            <div class="col-md-6 col-lg-6">
                <a class="portfolio-item d-block mx-auto">
                    <div class="portfolio-image">
                        <div class="portfolio-image-position">
                            <a href="index.php?action=chapter&amp;id=<?php echo $chapter->getId(); ?>"><img src="<?php echo $chapter->getImageFileUrl(); ?>" class="img-fluid"></a>
                        </div>
                        <div class="portfolio-text-image">
                            <a href="index.php?action=chapter&amp;id=<?php echo $chapter->getId(); ?>"><p style="color:white;font-weight: bold;"><?php echo $chapter->getTitle(); ?></p></a>
                        </div>
                    </div>
            </div>
                <?php
            }
            ?>

        </div>
    </section>


    <!-- Bibliographie Section -->

    <section class="bg-primary text-white mb-0" id="bibliographie">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Bibliographie</h2>
            <hr class="star-light mb-8"> <br/>
            <div class="row">
                <?php
                foreach ($books as $book)
                {
                    ?>
                    <div><img src="<?php echo $book->getImage(); ?>" HSPACE="10"/></div>

                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">

            <h2 class="text-center text-uppercase text-secondary mb-0">Me contacter</h2>
            <hr class="star-dark mb-5">
            <!-- Errors -->
            <div align="center">
		        <?php if (isset($error)){ ?>
                <div class="alert alert-danger">
			        <?php echo $error;} ?></div>
		        <?php if (isset($success)){?>
                <div class="alert alert-success">
			        <?php echo $success;} ?></div>

            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <form action="index.php?action=contact" method="post" name="contactform">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nom</label>
                                <input class="form-control" name='name' type="text" placeholder="Nom" value="<?php $name ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Adresse mail</label>
                                <input class="form-control" name='email' type="text" placeholder="Adresse mail" value="<?php $email ?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Message</label>
                                <textarea class="form-control" name='message' rows="5" placeholder="Message" <?php $message ?>></textarea>
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
unset($_SESSION['inputs']);
unset($_SESSION['error']);
unset($_SESSION['success']);
?>