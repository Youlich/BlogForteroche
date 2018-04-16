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
                        <?php $date =  date_create($comment->getCommentDate());
                        echo date_format($date,'d.m.Y'); ?>

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
                <?php } ?>
            </tbody>
        </table>
        <br/>

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
