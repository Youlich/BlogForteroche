
<header class="bg-primary text-white text-center">
        </br></br></br>
        <h1>Inscription Membre</h1>
        </br></br>
</header>

</br>
<body class="top">

<div align="center">

    </br></br>

    <form action="index.php?action=inscription" method="post">


        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">Pseudo </label>
                </td>
                <td>
                    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" />(*) <em>supérieur à 3 caractères</em>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Mot de passe</label>
                </td>
                <td>
                    <input type="password" placeholder="Votre mot de passe" name="pass" id="pass"  />(*) <em>supérieur à 6 caractères</em>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="pass">Retapez votre mot de passe</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmation mot de passe" name="newpass" id="newpass"  />(*)
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="email">Adresse e-mail</label>
                </td>
                <td>
                    <input type="text" placeholder="Votre adresse mail" name="email" id="email"  />(*)
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <br><br>
                    <input class="btn btn-success btn-md" type="submit" name="submit" value="S'inscrire" />
                </td>
            </tr>
        </table>
    </form>

<br>

<?php
unset($_SESSION['error']);?>

</div>
</body>

