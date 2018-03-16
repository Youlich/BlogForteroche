<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Commentaires</h1>
        </br></br></br>
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
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($comments as $comment)
{
    ?>
            <tr>
                <td></td>
                <td></td>
               <td>
                   <?php echo $comment->getMembrePseudo();?>
               </td>
                <td>
                    <?php echo $comment->getCommentDate(); ?>
                </td>
                <td>
                    <?php echo $comment->getComment(); ?>
                </td>
                <td>
                    <input type="button" value="Valider">
                    <input type="button" value="Supprimer">
                </td>
            </tr>
    <?php
}
?>
</tbody>
</table>
<?php require ('Footer.php'); ?>
</body>
</html>