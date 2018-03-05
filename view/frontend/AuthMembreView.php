<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php'); ?>
<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Connexion Membre</h1>
        </br></br>
    </div>
</header>
</br></br>
<body class="top">
<div align="center">
    <?php
    if (isset($_GET['success'])) {
        echo "Vous êtes bien inscrit, merci de vous connecter";
        }
   if (isset($_GET['supp'])) {
        echo "Votre compte membre est supprimé";
    }
    if (isset($authMembre)) {
        echo $authMembre;
    }
    ?>

    <form action="" method="post">

        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo</label>
                </td>
                <td>
                    <input type="text" name="pseudo" id="pseudo" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Mot de passe</label>
                </td>
                <td>
                    <input type="password" name="pass" id="pass" />
                </td>
            </tr>
            <tr>
                <td align="left">
                    <label for="auto">Connexion automatique</label>
                </td>
                <td>
                    <input type="checkbox" checked="true" id="case" />
                </td>
            </tr>
            <tr>
                <td align="right">
                </td>
                <td>
                    <input type="submit" name= "submit" value="Se connecter" class="btn btn-success btn-md" />
                </td>
            </tr>
        </table>
        </br></br>


    </form>

    <h5><em><a href="index.php?action=inscripMembre">S'inscrire</a></em></h5>
</div>
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