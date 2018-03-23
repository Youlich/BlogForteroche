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
<!-- La page complète -->
<div class="container">

    <!-- section livre -->
    <div class="form-group">

        <form action="index.php?action=publier" method="post">
            <div>
                <label>Sélectionnez votre livre</label>
                <select name="book" id="book" size="1">
                    <?php foreach ($books as $book) { ?>
                    <option value="book"><?php echo $book->getTitle();  ?></option> <?php } ?>

                </select>
            </div>
            <div>
                <input type="submit" class="button" value="Sélectionner" />
            </div>
            <br/>
        </form>
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
                            <input class="btn btn-success btn-md" type="submit" id="submit" name="submit" value="Ajouter" />
                        </td>
                    </tr>
                </table>
        </form>
    <?php endif; ?>
    <br/>
   </div>
    <br/>

    <!-- Fin section livre -->

    <!-- Section chapitre -->

    <div class="form-group">

        <form action="index.php?action=publier" method="post">
            <div>
                <label>Sélectionnez votre chapitre</label>
                <select  id="chapter" size="1" >
                    <?php foreach ($chapters as $chapter) { ?>
                    <option name="chapterSelect" value="$selectChapter"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
             <div>
                <input type="submit" name="chapter" class="button" value="Sélectionner" />
            </div>
                </select>
            </div>

        <br/>
        </form>

                <div> <a href="index.php?action=publier&amp;publierchapitre=1 ">
                        <input type="button" class="bouton" name= "button" value="Publier un nouveau chapitre"></a></div>
                        <div> <a href="index.php?action=publier&amp;modifierchapitre=1">
                                <input type="button" class="bouton" name="button" value="Modifier le chapitre"></a></div>
                        <div><a href="index.php?action=publier&amp;supprimerchapitre=1">
                                <input type="button" class="bouton" name="button" value="Supprimer le chapitre"></a></div>
                <?php if (!empty($_GET['publierchapitre'])){ ?>
                <form action="index.php?action=addchapter" method="post" enctype="multipart/form-data" >
                    <table>
                        <tr>
                            <td>
                                <br/><br/>
                                <input type="hidden" value="" <!-- ici le bookId -->
                                <label for="titre">Titre du chapitre : </label>
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
               <?php } elseif (!empty($_GET['modifierchapitre'])){ ?>
        <form action="index.php?action=modifchapter" method="post" enctype="multipart/form-data" >
            <table>
                <tr>
                    <td>
                        <br/><br/>
                        <input type="hidden" value="<?php $chapter->getbookId(); ?>"
                        <label for="titre">Nouveau titre de chapitre : </label>
                    </td>
                    <br/><br/>
                    <td>

                        <input type="text" name="titrechapitre" id="titrechapitre" style="width: 200%;" placeholder=""/>

                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Contenu</label>
                    </td>
                    <td>
                        <textarea class="content" id="contenu" name="contenu" rows="15" placeholder="<?php echo $chapter->getContent(); ?>" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Télécharger une image<br/> (tous formats | max. 1 Mo) :</label>
                    </td>
                    <td>
                        <input type="file" name="image" id="image"/>
                        <input type="hidden" name="MAX_FILE_SIZE" value="12345" placeholder="<?php echo $chapter->getImage(); ?>" />

                    </td>
                </tr>
                <tr>
                    <td >
                        <input class="btn btn-success btn-md" type="submit" id="submit" name="submit" value="Publier" />
                    </td>
                </tr>
            </table>
        </form>

               <?php } ?>
        <br/>
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
