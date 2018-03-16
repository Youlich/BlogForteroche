<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Membres</h1>
        </br></br></br>
    </div>
</header>
<body class="top">
<br/>

<table class="table table-bordered text-center">
    <thead class="thead table-active">
    <tr>
        <th scope="col">Pseudo</th>
        <th scope="col">Date d'inscription</th>
        <th scope="col">Email</th>
        <th width="15%" scope="col">Nombre de commentaires</th>
        <th width="15%" colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>

<?php
foreach ($membres as $membre)
{
?>
    <tr>
            <td><?php echo $membre->getPseudo();?></td>

            <td><?php echo $membre->getDateInscription(); ?></td>

            <td><?php echo $membre->getEmail(); ?></td>

            <td> <?php echo $membre->getNbcomms(); ?></td>
            <td>
             <input type="button" value="Alerter">
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

