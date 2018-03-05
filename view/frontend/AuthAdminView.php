<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php'); ?>

<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Connexion Administrateur</h1>
        </br></br>
    </div>
</header>
</br></br>

<body class="top">
<div align="center">
    <form action="" method="post">

        <?php

        if (isset($connAdmin)) {
            echo $connAdmin;
        }

        ?>

        <table>
            <tr>
                <td align="right">
                    <label for="login">Login</label>
                </td>
                <td>
                    <input type="text" name="login" id="login" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mdp">Mot de passe</label>
                </td>
                <td>
                    <input type="password" name="mdp" id="mdp" /><br/><br/>
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
        <br/><br/>

    </form>


</div>
<?php include('Footer.php');?>

<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
</body>
</html>