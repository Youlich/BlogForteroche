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


    <h5>Mon nombre de commentaires : <em> <?php echo $_SESSION['nbcomms']?></em></h5><br/>
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
    <!--page de départ-->
    <div align="center">
    <h5><em><a href="index.php?action=profilMembre&amp;afficher_infos_a_modifier=1">Modifier mon pseudo ou mot de passe</a></em></h5>

    <!--page rechargée après clic sur le lien-->
    <?php if (!empty($_GET['afficher_infos_a_modifier'])): ?>
        <form action="index.php?action=modifpseudo_mdp&amp;idmembre=<?= $_SESSION['id']?>" method="post">
            <table>

                        <p>(*) informations obligatoires</p><br/>

                <tr>
                    <td align="right">
                        <label for="pseudo">Mon nouveau pseudo (ou actuel) : </label>
                    </td>
                    <td>
                        <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $_SESSION['id']?>" />
                        <input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo']?>" />(*) <em>supérieur à 3 caractères</em><br>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="pass">Mon nouveau mot de passe (ou actuel) : </label>
                    </td>
                    <td>
                        <input type="password" name="pass" id="pass"/>(*) <em>supérieur à 6 caractères</em><br>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="pass">Retapez votre nouveau mot de passe (ou actuel) : </label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmation mot de passe" name="newpass" id="newpass"  />(*) <em>supérieur à 6 caractères</em>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                    </td>
                    <td>
                        <a href="">J'ai oublié mon mot de passe</a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-success btn-md" type="submit" name="submit" value="Modifier" />
                    </td>

                </tr>
            </table>
        </form>
    <?php endif;?>
    <br/>
    <!--page de départ-->

    <h5><em><a href="index.php?action=profilMembre&amp;afficher_email_a_modifier=1">Modifier mon email</a></em></h5>

    <!--page rechargée après clic sur le lien-->
    <?php if (!empty($_GET['afficher_email_a_modifier'])): ?>
        <form action="index.php?action=modifemail&amp;idmembre=<?= $_SESSION['id']?>" method="post">

            <table>
                    <tr>
                        <td align="right">
                            <label for="email">Modifier mon Email : </label>
                        </td>
                        <td>
                            <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $_SESSION['id']?>" />
                            <input type="text" name="email" id="email" value="<?php echo $_SESSION['email']?>" /><br>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="btn btn-success btn-md" type="submit" name="submit" value="Modifier" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php endif; ?>

        <br/>

        <h5><em><a href="">Ajouter un avatar </em></h5><br/>

        <h5><em><a href="index.php?action=suppMembre&amp;id=<?php echo $_SESSION['id']?>">Supprimer mon compte</a></em></h5>( attention ! pas de retour arrière possible )
        <br/><br/>
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

</body>
</html>
