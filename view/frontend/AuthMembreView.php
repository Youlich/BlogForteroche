
<!DOCTYPE html>
<html lang="fr">

<br><br>

<?php require ('Header.php'); ?>

<?php
if (isset($_GET['success=ok'])) {
    echo "Vous êtes bien inscrit, merci de vous connecter";
}
?>

<body id="top">

<div class = "corps" align="center">

    <h1>Connexion Membre</h1>
    <br /> <br />

    <form action="" method="post">

        <?php

        // Si la variable $error_message est setté
        if (isset($error_message)) {
            $session->setFlash('$error_message', 'alert');

        }
        ?>
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

       <h5><em><a href="index.php?action=inscripMembre">Créer votre compte ici</a></em></h5>
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