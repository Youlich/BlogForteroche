
<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Votre profil <?php echo $pseudo ?></h1>
        <br/><br/><br/>
</header>
<br/>

<body class="top">


<div align="center">

    <h5>Ma date d'inscription : <em>le <?php $date = date_create($membre->getDateInscription()) ;
            echo date_format($date,'d.m.Y'); ?></em></h5><br/>
    <h5> Mon email : <em><?php echo $email;?></em></h5><br/>


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
        <form action="index.php?action=modifemail&amp;idmembre=<?= $id?>" method="post">
            <div class="form-group">
                <br/>
                <label for="email" class="col-sm-6 col-form-label">Nouvelle adresse mail : </label>
                <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $id ?>" />
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" /><br>
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

    <div align="center">
        <h5><em><a href="index.php?action=accueil">Retour à l'accueil</em></h5>
    </div>

<br/>
<br/>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>

</div>
</body>
