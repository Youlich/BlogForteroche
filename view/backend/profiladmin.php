<header class="bg-primary text-white text-center">
        </br></br></br>
        <h1>Mon profil</h1>
        <br/><br/><br/>
</header>

<body class="top">
<div class="container">

<br/><br/>

        <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo $admin->getPhoto(); ?>" alt="Jean Forteroche" >

            <br/><br/>

<br/><br/>
<form method="post" action="index.php?action=modifmessage"">
            <div class= "input-group" >
                <label for="content">Votre message : </label>
                <textarea class="content" id="message" name="message" rows="15"> <?php echo $admin->getMessage(); ?> </textarea>
            </div> <br/><br/>
            <div class="text-center">
                <input class="btn btn-success btn-md" type="submit" id="submit" name="modifier" value="Modifier mon message" />
            </div>
</form>
    <br/><br/>

<div align="center" id="endpage"> <a href="index.php?action=administration">Retour page d'administration</a> </div>
<br/>
</div>

</body>

<?php

unset($_SESSION['error']);
unset($_SESSION['success']);?>