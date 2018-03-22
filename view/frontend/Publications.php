<!DOCTYPE html>
<html lang="fr">

<?php require ('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
    </div>
</header>
<body class="top">

<br/><br/>
<div class="container">

    <div class="form-group">
            <div>
                <label>Livre</label>
                <select name="book" id="book" size="1">
                    <?php foreach ($books as $book) { ?>
                    <option value="<?php echo $book->getTitle();  ?>"><?php echo $book->getTitle();  ?></option> <?php } ?>
                </select>
                <!-- cette sélection doit donner un bookID pour le chapitre -->
            </div>
            <br/>
            <div>  <a href="index.php?action=publier&amp;publierlivre=1">
                    <input type="button" class="bouton" name= "button" value="Publier un nouveau livre"></a></div>
            <?php if (!empty($_GET['publierlivre'])): ?>
        <form action="index.php?action=addbook" method="post" >
                <table>
                    <tr>
                        <td align="right">
                            <br/>
                            <label for="titre">Nouveau titre de livre : </label>
                        </td>
                        <td>
                            <input type="text" name="titrelivre" id="titrelivre" style="width: 200%;"/>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input class="btn btn-success btn-md" type="submit" id="submitaddbook" name="submitaddbook" value="Ajouter" />
                        </td>
                    </tr>
                </table>
        </form>
    <?php endif; ?>
    <br/>
   </div>
    <br/>
    <div class="form-group">
            <div>
                <label>Chapitre</label>
                <select name="chapitre" id="chapitre" size="1">
                    <?php foreach ($chapters as $chapter) { ?>
                    <option value="<?php echo $chapter->getTitle(); ?>"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
                </select>
            </div>
        <br/>
                <div> <a href="index.php?action=publier&amp;publierchapitre=1">
                        <input type="button" class="bouton" name= "button" value="Publier un nouveau chapitre"></a></div>
                <?php if (!empty($_GET['publierchapitre'])): ?>
                <form action="index.php?action=addchapter" method="post" enctype="multipart/form-data" >
                    <table>
                        <tr>
                            <td>
                                <br/><br/>
                                <input type="hidden" value="" <!-- ici le bookId -->
                                <label for="titre">Nouveau titre de chapitre : </label>
                            </td>
                            <td><br/><br/>
                            <input type="text" name="titrechapitre" id="titrechapitre" style="width: 200%;" placeholder="Chapitre x : titre"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label>Contenu</label>
                            </td>
                            <td>
                            <textarea class="content" id="contenu" name="contenu" rows="15" placeholder="" ></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Télécharger une image<br/> (tous formats | max. 1 Mo) :</label>
                            </td>
                            <td>
                                <input type="file" name="image" id="image"/>
                                <input type="hidden" name="MAX_FILE_SIZE" value="12345" />

                            </td>
                        </tr>
                        <tr>
                            <td >
                                <input class="btn btn-success btn-md" type="submit" id="submit" name="submit" value="Publier" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php endif; ?>
        <br/>
    </div>
    <br/>
    <div class="form-group">




    </div>
    <br>

    <div class="form-group" align="center">

        <button type="submit" class="btn btn-primary btn-xl" id="Button">Modifier</button>
        <button type="submit" class="btn btn-primary btn-xl" id="Button">Supprimer</button>
    </div>


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
<?php require ('Footer.php');?>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>
