<!DOCTYPE html>
<html lang="fr">

<body>

<form action="index.php?action=deletechapter&amp;id=<?php echo $_POST['chapterselect']; ?>" method="post" enctype="multipart/form-data" >
        <div class= "input-group" >
            <input type="hidden" name="ChapterId" value="<?php echo $_POST['chapterselect']; ?>">
            <label for="titrechapter">Titre du chapitre : </label>
            <input type="text" name="titrechapter" id="titrechapter" style="width: 200%;" value="<?php echo $chapterselect->getTitle(); ?>">
            <input type="hidden" name="id" value="<?php echo $chapterselect->getId(); ?>">
        </div>
        <br/>
        <div class="input-group" >
            <label for="content">Contenu : </label>
            <textarea class="content" id="content" name="content" rows="15"> <?php echo $chapterselect->getContent(); ?> </textarea>
        </div> <br/><br/>
        <div>
            <h6>Mon image :</h6>
            <br/>
            <img src="public/images/<?php echo $chapterselect->getImage(); ?>" style="width: 15%;">

        </div>
        <br/>
        <br/><br/>
        <div class="text-center">
            <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Supprimer" />
        </div>
        </div>
</form>

</body>
</html>