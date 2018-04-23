<header class="bg-primary text-white text-center">
        </br></br></br>
        <h1>Membres</h1>
        </br></br></br>
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

            <td><?php $date = date_create($membre->getDateInscription());
                echo date_format($date,'d.m.Y'); ?></td>

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
</body>


