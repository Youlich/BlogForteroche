<!DOCTYPE html>
<html lang="fr">

<body>

<form action="index.php?action=addchapter" method="post" enctype="multipart/form-data" >
    <div class= "input-group">
        <input type="hidden" name="bookSelect" value="<?php echo $_POST['bookSelect'] ?>"
        <label for="titrelivre">Titre du livre : </label>
        <input type="text" name="titrelivre" id="titrelivre"  style="width: 200%;" value="<?php echo $bookSelect->getTitle(); ?>"/>
    </div>
    <br/><br/>
    <div class= "input-group">
        <label for="titrechapitre">Titre du chapitre : </label>
        <input type="text" name="titrechapitre" id="titrechapitre"  style="width: 200%;" placeholder="Chapitre x : titre"/>
    </div>
    <br/><br/>
    <div class= "input-group">
        <label>Contenu</label>
        <textarea class="content" id="content" name="content" rows="15" placeholder="" ></textarea>
        <br/><br/>
    </div>
    <!--téléchargement de l'image-->
    <div class= "input-group">
        <label >Choisissez votre image :&nbsp; </label>
        <input type="file" name="image" id="image">
        <br/><br/>
    </div>
    <div align="center">
        <input class="btn btn-success btn-md" type="submit" id="submit" name="ajout" value="Publier" />
    </div> <br/>
</form>


</body>
</html>