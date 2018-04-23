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
    <br/><br/>
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
    <br/>

    <!-- Bouton ajout chapitre -->
    <a href="index.php?action=boutonaddchapter">
            <input type="button" style="text-decoration: none;" class="btn btn-secondary btn-lg btn-block" name= "button" value="Publier un nouveau chapitre"></a>
    <br/><br/><br/>

    <!-- Bouton modification chapitre -->

    <a href="index.php?action=boutonmodifchapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Modifier un chapitre"></a>
    <br/><br/><br/>

    <!-- Bouton suppression chapitre -->
    <a href="index.php?action=boutondeletechapter">
        <input type="button" class="btn btn-secondary btn-lg btn-block" name="button" value="Supprimer un chapitre"></a>
    <br/><br/>


<br/>
<div id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a>
<br/>
<br/>
</div>
</body>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>
