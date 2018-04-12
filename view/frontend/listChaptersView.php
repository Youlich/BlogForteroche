<?php ob_start(); ?>

<em><h5 class="link text-center"><a href="index.php?action=lastchapter" class= "info" >Voir mon dernier chapitre</a></em> </h5>

<?php
foreach ($chapters as $chapter)
{
    ?>
    <div class="post">
        <div class="image">
        <?php if ($chapter->getImageId()): ?>
            <img src="<?php echo $chapter->getImageFileUrl(); ?>" HSPACE="15" />
        <?php endif; ?>
        </div>
        <br/>
        <h3>
            <?= $chapter->getTitle() ?>
        </h3>

        <?= $chapter->getResum() ?>
        <br/><br/>
        <strong><a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Lire la suite</a></strong>
        <br/><br/>
    </div>
    <?php
}
?>
<br/><br/>



<?php $content = ob_get_clean(); ?>


<?php require('templateBlog.php'); ?>

