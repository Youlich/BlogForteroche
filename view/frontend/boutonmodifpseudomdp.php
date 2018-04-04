<!DOCTYPE html>
<html lang="fr">

<?php require('Header.php'); ?>
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
    <h5>Ma date d'inscription : <em>le <?php $date = date_create($membre->getDateInscription()) ;
                                echo date_format($date,'d.m.Y'); ?></em></h5><br/>

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
<br/><br/>

<div class="container">

    <!-- Partie modifier pseudo et mdp-->
    <a href="index.php?action=boutonmodifpseudomdp">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon pseudo ou mon mot de passe"></a>

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
    <br/>

    <!--Partie modifier mail-->
    <a href="index.php?action=boutonmodifiermail">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon email"></a>

    <br/><br/><br/>
    <!--Partie Gérer les commentaires-->
    <a href="index.php?action=boutonafficherlescommentaires">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Gérer mes commentaires"></a>

    <br/><br/><br/>

        <!--Partie suppression-->
        <a href="index.php?action=boutonsupprimerprofil">
                <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Supprimer mon compte"</a>
    <br/><br/><br/>

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

</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>
