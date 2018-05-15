<header class="bg-primary text-white text-center">
        <br/><br/><br/>
        <h1>Publications</h1>
        <br/><br/><br/>
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
    <br/>

    <form action="" method="post">
        <div class= "input-group" >
            <select name="bookSelect" class= "custom-select" id= "inputGroupSelect04" >
                <option selected > <?php echo $selectedbook ?> </option>
                <?php foreach ($books as $book) { ?>
                    <option value="<?php echo $book->getId(); ?>"><?php echo $book->getTitle();  ?></option> <?php } ?>
            </select>
            <div class= "input-group-append">
                <input type="submit" class= "btn btn-outline-secondary" name="okbook">
            </div>
        </div>
        <br/>
    </form>

    <?php if ($bookSelect) { ?>
        <!-- Saisie des informations : titre, contenu et téléchargement image-->

        <form action="index.php?action=addchapter" method="post" enctype="multipart/form-data" >

            <div class= "input-group">
                <input type="hidden" name="bookSelect" value="<?php echo $bookId ?>">
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


    <?php } ?>

    <br/>

    <!-- Bouton modification chapitre -->

    <a href="index.php?action=boutonmodifchapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a>
    <br/><br/><br/>

    <!-- Bouton suppression chapitre -->
    <a href="index.php?action=boutondeletechapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a>
    <br/><br/>

</div>

<br/>
<div align="center" id="endpage">
<a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
<br/>
</body>

