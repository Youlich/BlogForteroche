
<header class="bg-primary text-white text-center">
        </br></br></br>
        <h1>Connexion Membre</h1>
        </br></br>
</header>

</br></br>
<body class="top">
<div class="container" align="center">

    <form action="" method="post">

        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo</label>
                </td>
                <td>
                    <input type="text" name="pseudo" id="pseudo" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Mot de passe</label>
                </td>
                <td>
                    <input type="password" name="pass" id="pass" />
                </td>
            </tr>
            <tr>
                <td><br/></td>
                <td></td>
            </tr>
            <tr>
                <td align="right">
                </td>
                <td>
                    <input type="submit" name= "submit" value="Se connecter" class="btn btn-success btn-md" />
                </td>
            </tr>

        </table>
        </br></br>
    </form>
<br/>

<?php
unset($_SESSION['error']);
unset($_SESSION['success']);?>

</div>
</body>
