<!DOCTYPE html>
<html lang="fr">

<body>

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


</body>
</html>