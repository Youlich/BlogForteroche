<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Votre profil <?php echo $_SESSION['pseudo']?></h1>
        <br/><br/><br/>
</header>
<body>
<br/>



    <div align="center">

        <h5>Mon nombre de commentaires : <em> <?php echo $membre->getNbcomms(); ?></em></h5><br/>
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


    <br/><br/>

</div>
</body>