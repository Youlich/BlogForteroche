<?php ob_start(); ?>

    <h5><em><a href="lastChapter.php" class= "info" >Voir mon dernier chapitre</a></em> </h5>

<?php
foreach ($chapters as $chapter)
{
    ?>
    <div class="post">
        <p>
        <div class="image">
            <img src="public/images/<?php echo $chapter->getImage();?>" HSPACE="15"  />
        </div>

        <h3>
            <?= htmlspecialchars($chapter->getTitle()) ?>
        </h3>

        <?= nl2br(htmlspecialchars($chapter->getResum())) ?>
        <br/><br/>
        <strong><a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Lire la suite</a></strong>
        <br/><br/>
    </div>
    <?php
}
?>

<?php $content = ob_get_clean(); ?>


<?php require('templateBlog.php'); ?>

