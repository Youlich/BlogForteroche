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

    <h5>Mon nombre de commentaires : <em> <?php echo $membre->getNbcomms();  ?></em></h5><br/>
    <h5>Ma date d'inscription : <em>le <?php $date = date_create($membre->getDateInscription()) ;
            echo date_format($date,'d.m.Y'); ?></em></h5><br/>
    <h5> Mon email : <em><?php echo $_SESSION['email']?></em></h5><br/>


</div>
<br/><br/>

<div class="container">

    <!-- Partie modifier pseudo et mdp-->
        <a href="index.php?action=boutonmodifpseudomdp">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon pseudo ou mon mot de passe"></a>
    <br/><br/><br/>

    <!--Partie modifier mail-->
    <a href="index.php?action=boutonmodifiermail">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon email"></a>
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
    <br/>

    <!--Partie Gérer les commentaires-->
    <a href="index.php?action=boutonafficherlescommentaires">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Gérer mes commentaires"></a>
    <br/><br/><br/>

    <!--Partie suppression-->
    <a href="index.php?action=boutonsupprimerprofil">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Supprimer mon compte"</a>
    <br/><br/><br/>

    <div id="endpage" class="col-lg-4 mx-auto" align="center">
        <?php if (isset($_SESSION['error'])){ ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];} ?></div>
        <?php unset($_SESSION['error']);?></div>
    <div class="col-lg-4 mx-auto" align="center">
        <?php if (isset($_SESSION['success'])){?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];} ?></div>
    </div>

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