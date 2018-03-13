<?php

$nom_image = "";  // le nom de votre image avec l'extension jpeg
$texte = "votre texte";  // Le texte que vous désirez écrire sur l'image

header ("Content-type: image/jpeg");
$image = imagecreatefromjpeg($nom_image);
$blanc = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, 150, 150,$texte, $blanc);
imagejpeg($image);
?>

<!--
C'est ici qu'on incorpore l'image. Donc ouvrez une page et placez la balise ci dessous
C'est donc la balise HTML classique IMG
-->

<img src="create_image.php">