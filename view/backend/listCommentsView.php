<!DOCTYPE html>
<html lang="fr">

<?php require('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/><br/>
        <h1>Commentaires</h1>
        <br/><br/><br/>
    </div>
</header>
<body class="top">
<br/>
<table class="table table-bordered text-center">
    <thead class="thead table-active">
    <tr>
        <th>Livre</th>
        <th>Chapitre</th>
        <th>Pseudo</th>
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
                    <?php echo $comment->getBook()->getTitle(); ?>
                    </td>
                <td>
                    <?php echo $comment->getChapter()->getTitle(); ?>
                </td>
               <td>
                   <?php echo $comment->getMembrePseudo();?>
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
                    <a href="index.php?action=approved&amp;id=<?php echo $comment->getId(); ?>"><input type="button" value="Accepter"></a>
                    <a href="index.php?action=refused&amp;id=<?php echo $comment->getId(); ?>"><input type="button" value="Refuser">
                </td>
            </tr>
    <?php
}
?>
</tbody>
</table>
<div align="center"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
</body>
<?php include('view\frontend\Footer.php');?>

</html>