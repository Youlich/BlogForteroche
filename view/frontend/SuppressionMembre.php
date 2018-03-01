<!DOCTYPE html>
<html lang="fr">

<br><br>

<?php require ('Header.php'); ?>


<body id="top">

<div class = "corps" align="center">


    <h2>Votre pseudo est <?php echo $_SESSION['pseudo']?></h2>

    <br>
    Etes-vous sûr de vouloir supprimer votre compte ?<br/>

    <a href="index.php?action=suppMembre&amp;id=<?php echo $_SESSION['id']?>">  OUI </a>
ou
    <a href="index.php?action=accueil">NON</a>

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