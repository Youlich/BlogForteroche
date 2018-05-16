
<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Votre profil <?php echo $pseudo?></h1>
        <br/><br/><br/>
</header>

<br/>

<body class="top">


<div align="center">

    <h5>Ma date d'inscription : <em>le <?php $date = date_create($membre->getDateInscription()) ;
            echo date_format($date,'d.m.Y'); ?></em></h5><br/>
    <h5> Mon email : <em><?php echo $email ?></em></h5><br/>

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
    <form action="index.php?action=listcommentsmembre&idmembre=<?= $id?>" method="post">
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
            foreach ($comments as $comment)
            {
                ?>
                <tr>
                    <td>
                        <?php echo $comment->getBook()->getTitle();?>
                    </td>
                    <td>
                        <?php echo $comment->getChapter()->getTitle();?>
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
                        <a href="index.php?action=comment&numComm=<?php echo $comment->getId(); ?>"><input type="button" value="Modifier"></a>
                        <a href="index.php?action=deletecomment&id=<?php echo $comment->getId(); ?>"><input type="button" value="Supprimer"></a>
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

        <div align="center">
            <h5><em><a href="index.php?action=accueil">Retour à l'accueil</em></h5>
        </div>

<br/>
<br/>

</div>
</body>