<!DOCTYPE html>
<html lang="fr">

<?php require('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/><br/>
        <h1>Mon profil</h1>
        <br/><br/><br/>
    </div>
</header>

<body class="top">
<div class="container">

<br/><br/>
<form method="post" action="index.php?action=modifAdmin" enctype="multipart/form-data">
        <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo $admin->getPhoto(); ?>" alt="Jean Forteroche" >
        <div class= "input-group">
            <label >Choisissez votre nouvelle photo :&nbsp; </label>
            <input type="file" name="image" id="image"></div>
            <br/><br/>
            <br/>
            <div class= "input-group" >
                <label for="content">Votre message : </label>
                <textarea class="content" id="message" name="message" rows="15"> <?php echo $admin->getMessage(); ?> </textarea>
            </div> <br/><br/>
            <div class="text-center">
                <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Modifier" />
            </div>
</form>
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
<br/>
<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
</div>

</body>
<?php include('view/frontend/Footer.php');?>
</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>