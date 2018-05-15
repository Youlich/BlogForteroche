
<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Votre profil <?php echo $pseudo ?></h1>
        <br/><br/><br/>
</header>
<br/>

<body class="top">


<div align="center">

    <h5>Mon nombre de commentaires : <em> <?php echo $membre->getNbcomms();  ?></em></h5><br/>
    <h5>Ma date d'inscription : <em>le <?php $date = date_create($membre->getDateInscription()) ;
                                echo date_format($date,'d.m.Y'); ?></em></h5><br/>

    <h5> Mon email : <em><?php echo $email ?></em></h5><br/>

</div>
<br/><br/>

<div class="container">

    <!-- Partie modifier pseudo et mdp-->
    <a href="index.php?action=boutonmodifpseudomdp">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Modifier mon pseudo ou mon mot de passe"></a>

            <form action="index.php?action=modifpseudomdp&idmembre=<?= $id ?>" method="post">
                <div class="form-group">
                    <p>(*) informations obligatoires</p>
                    <br/><br/>
                    <label for="pseudo" class="col-sm-6 col-form-label">Mon nouveau pseudo (ou actuel) : (*) <em>supérieur à 3 caractères</em> </label>
                    <div class="col-sm-15">
                        <input type="hidden" name="idmembre" id="idmembre" value="<?php echo $id ?>" />
                        <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $pseudo ?>" /><br>
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

<br/>
<br/>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>

</div>
</body>