<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php'); ?>
<header class="bg-primary text-white">

    <div class="container text-center">
        <br/><br/><br/>
        <h1>Votre profil <?php echo $_SESSION['pseudo']?></h1>
        <br/><br/><br/>
    </div>
</header>
<br/>
<body class="top">


    <div align="center">

            <h5>Mon nombre de commentaires : <em> <?php echo $nbComms ?></em></h5><br/>
            <h5>Ma date d'inscription : <em>le <?php echo $_SESSION['date_inscription']=date("d-m-Y")?></em></h5><br/>

            <h5> Mon email : <em><?php echo $_SESSION['email']?></em></h5><br/>

            <div class="col-lg-4 mx-auto" align="center">
                <?php if (isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];} ?></div>
                <?php unset($_SESSION['error']);?></div>
            <div class="col-lg-4 mx-auto" align="center">
                <?php if (isset($_SESSION['success'])){?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success'];} ?></div>
            </div>
    </div>


    <div class="container">

            <!-- Partie modifier pseudo et mdp-->
            <div>
           <a href="index.php?action=profilMembre&amp;afficher_infos_a_modifier=1">
               <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon pseudo ou mot de passe"></a> </div>
            <!--affichage du formulaire après clic sur le lien-->
            <?php if (!empty($_GET['afficher_infos_a_modifier'])): ?>
                <form action="index.php?action=modifpseudo_mdp&amp;idmembre=<?= $_SESSION['id']?>" method="post">
                    <div class="form-group">
                                <p>(*) informations obligatoires</p>
                        <br/><br/>
                                <label for="pseudo" class="col-sm-6 col-form-label">Mon nouveau pseudo (ou actuel) : (*) <em>supérieur à 3 caractères</em> </label>
                                <div class="col-sm-15">
                                    <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $_SESSION['id']?>" />
                                    <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo']?>" /><br>
                                </div>
                                <label for="pass" class="col-sm-6 col-form-label">Mon nouveau mot de passe (ou actuel) : (*) <em>supérieur à 6 caractères</em><br></label>
                                <div class="col-sm-15">
                                    <input type="password" class="form-control"name="pass" id="pass"/>
                                </div>
                                <label for="pass" class="col-sm-6 col-form-label">Retapez votre nouveau mot de passe (ou actuel) : (*) <em>supérieur à 6 caractères</em><br></label>
                                 <div class="col-sm-15">
                                    <input type="password" class="form-control" placeholder="Confirmation mot de passe" name="newpass" id="newpass"  />
                                 </div>
                                <br/><br/>
                                <div align="center">
                                        <a href="" >J'ai oublié mon mot de passe</a>
                                        <br/><br/>
                                        <input class="btn btn-success btn-md" type="submit" name="submit" value="Modifier" />
                                </div>
                    </div>
                </form>
            <?php endif;?>
            <br/>

            <!--Partie modifier mail-->
        <div> <a href="index.php?action=profilMembre&amp;afficher_email_a_modifier=1">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon email"></a></div>
            <!--affichage du formulaire après clic sur le lien-->
            <?php if (!empty($_GET['afficher_email_a_modifier'])): ?>
                <form action="index.php?action=modifemail&amp;idmembre=<?= $_SESSION['id']?>" method="post">
                    <div class="form-group">
                        <br/>
                                    <label for="email" class="col-sm-6 col-form-label">Nouvelle adresse mail : </label>
                                    <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $_SESSION['id']?>" />
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['email']?>" /><br>
                                <div align="center">
                                    <input class="btn btn-success btn-md" type="submit" name="submit" value="Modifier" />
                                </div>
                    </div>
                    </form>
                <?php endif; ?>
                <br/>

        <!--Partie Gérer les commentaires-->
        <div> <a href="index.php?action=profilMembre&amp;afficher_commentaires=1">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Gérer mes commentaires"></a></div>

        <!--affichage du tableau après clic sur le lien-->
        <?php if (!empty($_GET['afficher_commentaires'])): ?>
        <br/>
            <form action="index.php?action=listcommentsmembre&amp;idmembre=<?= $_SESSION['id']?>" method="post">
                <table class="table table-bordered text-center">
                    <thead class="thead table-active">
                    <tr>
                        <th>Livre</th>
                        <th>Chapitre</th>
                        <th>Date du commentaire</th>
                        <th>Commentaire</th>
                        <th>Etat</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($commentsMembre as $comment)
                    {
                        ?>
                        <tr>
                            <td>
                                <?php echo $comment->getBook()->getTitle(); ?>
                            </td>
                            <td>
                                <?php echo $comment->getChapter()->getTitle(); ?>
                            </td>
                            <td>
                                <?php $date = $comment->getCommentDate();
                                echo $date = date('d.m.Y'); ?>
                            </td>
                            <td>
                                <?php echo $comment->getComment(); ?>
                            </td>
                            <?php $statut = $comment->getStatut();
                            if ($statut == 'Alerte') { ?>
                                <td style="color :red;">
                                    <?php echo $comment->getStatut(); ?>
                                </td> <?php } else { ?>
                                <td style="color :black;">
                                    <?php echo $comment->getStatut(); ?>
                                </td> <?php
                            } ?>
                            <td>
                                <a href="index.php?action=Comment&amp;numComm=<?php echo $comment->getId(); ?>"><input type="button" value="Modifier"></a>
                                <a href="index.php?action=deletecomment&amp;id=<?php echo $comment->getId(); ?>"><input type="button" value="Supprimer"></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
        <?php endif; ?>
        <br/>

        <!--Partie suppression-->
        <div><a href="index.php?action=profilMembre&amp;supprimer_profil=1">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Supprimer mon compte"</a></div>
        <!--informations de confirmation suppression après clic sur le bouton-->
               <?php if (!empty($_GET['supprimer_profil'])):?> <br/>
                <div align="center">
                   <p class="confirmation">Etes-vous sur de vouloir supprimer votre compte ?</p>

                    <a href="index.php?action=suppMembre&amp;id=<?php echo $_SESSION['id']?>">OUI</a><br/>
                    <a href="index.php?action=profilMembre">NON</a>
                <?php endif; ?>
                </div>
                <br/><br/>
                <div align="center">
                <h5><em><a href="index.php?action=accueil">Retour à l'accueil</em></h5>
                </div>

</div>
<br/>
<br/>
<?php include('Footer.php');?>

            <!-- Scroll to Top Button -->
            <div class="scroll-to-top position-fixed ">
                <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
</div>
</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>