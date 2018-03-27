<!DOCTYPE html>
<html lang="fr">

<?php require ('HeaderAdmin.php');?>

<header class="bg-primary text-white">
    <div class="container text-center">
        <br/><br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
    </div>
</header>

<body class="top">
        <br/><br/>

        <!-- La page complète -->
        <div class="container">


                <!-- Partie ajout livre -->
            <div> <a href="index.php?action=publier&amp;publierlivre=1">
            <input type="button" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau livre"></a><br/><br/></div>
                    <?php if (!empty($_GET['publierlivre'])): ?>
                        <form action="index.php?action=addbook" method="post" >
                            <div class= "input-group" >
                              <label for="titre">Nouveau titre de livre : </label>
                              <input type="text" name="titrelivre" id="titrelivre" style="width: 200%;"/>
                            </div>
                                <br/>
                              <div class="text-center">
                              <input class="btn btn-success btn-md" type="submit" id="submit" name="submit" value="Publier" />
                              </div>

                        </form>
                    <?php endif; ?>

                    <br/>

                 <!-- Fin partie ajout livre-->

                <!-- Partie ajout chapitre -->

            <div><a href="index.php?action=publier&amp;publierchapitre=1 ">
                    <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau chapitre"></a><br/><br/></div>
                <?php if (!empty($_GET['publierchapitre'])){ ?>
                    <!--choix du livre-->
                    <div class= "input-group" >
                        <select name="bookSelect" class= "custom-select" id= "inputGroupSelect04" >
                            <option selected > Choisissez votre livre </option>
                            <?php foreach ($books as $book) { ?>
                                <option value="<?php echo $book->getId(); ?>"><?php echo $book->getTitle();  ?></option> <?php } ?>
                        </select>
                        <div class= "input-group-append" >
                            <button class= "btn btn-outline-secondary" type= "button" > Valider </button>
                        </div>
                    </div>
                    <br/>
                    <!--choix de l'image-->
                    <div align="right">
                        <form action="index.php?action=upload" method="post" enctype="multipart/form-data">

                                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                <input type="file" name="image" id="image">
                                <button class= "btn btn-outline-secondary" type= "submit" > Télécharger </button>
                            <?php var_dump($_FILES) ?>
                            <br/>
                        </form>
                    </div>

                <form action="index.php?action=addchapter" method="post" enctype="multipart/form-data" >

                            <div class= "input-group">
                                <label for="titrechapitre">Titre du chapitre : </label>
                                <input type="text" name="titrechapitre" id="titrechapitre" style="width: 200%;" placeholder="Chapitre x : titre"/>
                            </div>
                            <div class= "input-group">
                                <label>Contenu</label>
                                <textarea class="content" id="content" name="content" rows="15" placeholder="" ></textarea>
                                <br/><br/>
                            </div>

                    <div align="center">
                        <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Publier" />
                    </div> <br/>
                </form>

                <?php } ?>

                <!-- Fin partie ajout chapitre-->

                <!-- Partie modification -->

                 <a href="index.php?action=publier&amp;modifierchapitre=1">
               <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a><br/><br/>
             <?php if (!empty($_GET['modifierchapitre'])){ ?>
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
                 <?php if (isset($_POST['chapterselect'])) { ?>
                <form action="index.php?action=modifchapter&amp;id=<?php echo $_POST['chapterselect']; ?>" method="post">
                    <div class= "input-group" >
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
                    <img src="public/images/<?php echo $image=$chapterselect->getImage(); ?>" style="width: 15%;">
                    </div>
                    <br/>
                    <div class= "input-group" >
                        <div class= "custom-file" >
                            <input type= "file" name="image" class= "custom-file-input" id="image" >
                            <label type="hidden" class= "custom-file-label" for= "inputGroupFile04" > Choisir une nouvelle image </label>
                        </div>
                        <div class= "input-group-append" >
                            <button class= "btn btn-outline-secondary" type= "button" > Télécharger </button>
                        </div>
                    </div>
                    <br/><br/>

                    <div class="text-center">
                        <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Publier" />
                    </div>
                </form>
                 <?php } ?>
                <?php } ?>
                <br/>


            <!-- Fin de la partie modification -->

            <!-- Partie suppression-->

                    <a href="index.php?action=publier&amp;supprimerchapitre=1">
                            <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a><br/><br/>
                    <?php if (!empty($_GET['supprimerchapitre'])){ ?>
                        <form action="index.php?action=deletechapter&amp;id=<?php echo $_POST['chapterselect']; ?>" method="post" enctype="multipart/form-data" >
                            <div class= "input-group" >
                                        <select name="id" class= "custom-select" id= "inputGroupSelect04" >
                                         <option selected > Choisissez votre chapitre</option>
                                         <?php foreach ($chapters as $chapter) { ?>
                                        <option value="<?php echo $chapter->getId(); ?>"><?php echo $chapter->getTitle(); ?></option> <?php } ?>
                                        </select>
                                        <div class= "input-group-append" >
                                            <button class= "btn btn-outline-secondary" type= "button" > Valider </button>
                                        </div>
                                        <br/><br/>
                                        <div class="text-center">
                                        <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Supprimer" />
                                        </div>
                             </div>
                        </form>
                    <?php } ?>

        <!-- Fin partie suppression-->

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

        </div>
</body>
</html>

<?php require ('Footer.php');?>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>