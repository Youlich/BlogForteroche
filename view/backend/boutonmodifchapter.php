<!DOCTYPE html>
<html lang="fr">

<?php require('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
    </div>
</header>

<body class="top">
<br/><br/>

<div class="container">

    <!-- Bouton ajout livre -->
    <a href="index.php?action=boutonaddbook">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau livre"></a>
    <br/><br/><br/>

    <!-- Bouton ajout chapitre -->
    <a href="index.php?action=boutonaddchapter">
            <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau chapitre"></a>
    <br/><br/><br/>

    <!-- Bouton modification chapitre -->

    <a href="index.php?action=boutonmodifchapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a>
    <br/><br/>

    <!--Choix du chapitre à modifier -->
    <form action="" method="post">
        <div class= "input-group">
            <select name="chapterselect" class= "custom-select" id= "inputGroupSelect04" >
                <option selected > Choisissez votre chapitre</option>
                <?php foreach ($chapters as $chapter) { ?>
                    <option value="<?php echo $chapter->getId(); ?>"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
            </select>
            <div class= "input-group-append" >
                <input type="submit" class= "btn btn-outline-secondary" name="okchapter"  >
            </div> <br/><br/>
        </div>
    </form>

    <?php if (isset($_POST['chapterselect'])): ?>
        <form action="index.php?action=modifchapter&amp;id=<?php echo $_POST['chapterselect']; ?>" method="post" enctype="multipart/form-data">
            <div class= "input-group" >
                <input type="hidden" name="ChapterId" value="<?php echo $_POST['chapterselect']; ?>">
                <label for="titrechapter">Nouveau titre de chapitre : </label>
                <input type="text" name="titrechapter" id="titrechapter" style="width: 200%;" value="<?php echo $chapterselect->getTitle(); ?>">
            </div>
            <br/>
            <div class= "input-group" >
                <label for="content">Contenu : </label>
                <textarea class="content" id="content" name="content" rows="15"> <?php echo $chapterselect->getContent(); ?> </textarea>
            </div> <br/><br/>
            <div>
                <h6>Mon image :</h6>
                <br/>
                <img src="public/images/<?php echo $image->getName(); ?>" style="width: 15%;">
            </div>
            <br/>
            <!--téléchargement de l'image-->
            <div class= "input-group">
                <label >Choisissez votre nouvelle image :&nbsp; </label>
                <input type="file" name="image" id="image"></div>
            <br/><br/>
            <div class="text-center">
                <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Publier" />
            </div>
        </form>
    <?php endif; ?>
    <br/>

    <!-- Bouton suppression chapitre -->
    <a href="index.php?action=boutondeletechapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a>
    <br/><br/>

</div>

<div class="col-lg-4 mx-auto" align="center">
    <?php if (isset($_SESSION['error'])){ ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error'];} ?></div>
    <?php unset($_SESSION['error']);?></div>
<div class="col-lg-4 mx-auto" align="center">
    <?php if (isset($_SESSION['success'])){?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success'];} ?></div>
</div>
<br/>
<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
<br/>
        <!-- Scroll to Top Button -->
        <div class="scroll-to-top position-fixed ">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
</body>
<?php include('view/frontend/Footer.php');?>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>