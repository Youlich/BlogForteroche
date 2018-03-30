<!DOCTYPE html>
<html lang="fr">

<?php require('HeaderAdmin.php');?>

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

    </tr>
    </thead>
    <tbody>

<?php
foreach ($membres as $membre)
{
?>
    <tr>
            <td><?php echo $membre->getPseudo();?></td>

            <td><?php $date = $membre->getDateInscription();
                echo $date = date('d.m.Y'); ?></td>

            <td><?php echo $membre->getEmail(); ?></td>

            <td> <?php echo $membre->getNbcomms(); ?></td>

    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<div align="center"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>

<?php include('view\frontend\Footer.php');?>
</body>
</html>
