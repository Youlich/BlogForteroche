
<!DOCTYPE html>
<html lang="fr">

<body id="top">

<div class = "corps" align="center">


    <h1>Votre pseudo est</h1>

    <?php
    echo $_GET['pseudo']
    ?>

    <br>
    Etes-vous sûr de vouloir supprimer votre compte ?

    <a href="index.php?action=suppMembre&amp;pseudo=<?php $_GET['pseudo']?>">OUI</a>

    <a href="index.php?action=accueil">NON</a>



</body>
</html>