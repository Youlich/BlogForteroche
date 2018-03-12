<!DOCTYPE html>
<html lang="fr">

<?php require ('Header.php'); ?>
<header class="bg-primary text-white">
    <div class="container text-center">
        </br></br></br>
        <h1>Inscription Membre</h1>
        </br></br>
    </div>
</header>
</br>
<body class="top">
<div align="center">

    </br></br>
    <form action="index.php?action=addMembre" method="post">

        <p>Bienvenue sur la page d'inscription de mon site !<br/>

            Merci de remplir les champs (*) obligatoires et de prendre connaissance de <a href="index.php?action=charte"><strong>ma charte</strong></a> pour continuer.</p>
        <br>

        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo </label>
                </td>
                <td>
                    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" />(*) <em>supérieur à 3 caractères</em>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Mot de passe</label>
                </td>
                <td>
                    <input type="password" placeholder="Votre mot de passe" name="pass" id="pass"  />(*) <em>supérieur à 6 caractères</em>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Retapez votre mot de passe</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmation mot de passe" name="newpass" id="newpass"  />(*)
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="email">Adresse e-mail</label>
                </td>
                <td>
                    <input type="text" placeholder="Votre adresse mail" name="email" id="email"  />(*)
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br><br>
                    <input class="btn btn-success btn-md" type="submit" name="submit" value="S'inscrire" />
                </td>

                <div class="col-lg-4 mx-auto">
                <?php if (isset($_SESSION['error'])){ ?>
                    <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];} ?></div>
                <?php if (isset($_SESSION['success'])){?>
                    <div class="alert alert-success">
                    <?php echo $_SESSION['success'];} ?></div>
                    </div>
            </tr>
        </table>
    </form>
</div>
<br>
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
unset($_SESSION['error']);?>