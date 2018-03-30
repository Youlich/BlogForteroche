<!DOCTYPE html>
<html lang="fr">

<body>

<form action="" method="post">
    <div class= "input-group" >
        <select name="bookSelect" class= "custom-select" id= "inputGroupSelect04" >
            <option selected > Choisissez votre livre </option>
            <?php foreach ($books as $book) { ?>
                <option value="<?php echo $book->getId(); ?>"><?php echo $book->getTitle();  ?></option> <?php } ?>
        </select>
        <div class= "input-group-append">
            <input type="submit" class= "btn btn-outline-secondary" name="okbook">
        </div>
    </div>
    <br/>
</form>

</body>
</html>