<!DOCTYPE html>
<html lang="fr">

<?php require('Header.php'); ?>
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
                <td><br/></td>
                <td></td>
            </tr>
            <tr>
                <td align="right">
                </td>
                <td>
                    <input type="submit" name= "submit" value="Se connecter" class="btn btn-success btn-md" />
                </td>
            </tr>
                <div class="col-lg-4 mx-auto">
                    <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; ?></div>
                        <?php endif; ?>
                    <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success']; ?></div>
                        <?php endif; ?>
                </div>
        </table>
        </br></br>
    </form>
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


<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>