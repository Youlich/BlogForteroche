<?php ob_start(); ?>

    <h5><em><a href="index.php?action=lastchapter" class= "info" >Voir mon dernier chapitre</a></em> </h5>

<?php
foreach ($chapters as $chapter)
{
    ?>
    <div class="post">

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
<br/><br/>

<nav aria-label="...">
    <ul class="pagination pagination-lg justify-content-center">
        <li class="active">
            <a class="page-link" style="color: #18bc9c; border-color: #18bc9c;" href="#" tabindex="-1">1</a>
        </li>
        <li class="page-item"><a style="color: #18bc9c; border-color: #18bc9c;" class="page-link" href="#">2</a></li>
        <li class="page-item"><a style="color: #18bc9c; border-color: #18bc9c;" class="page-link" href="#">3</a></li>
    </ul>
</nav>


<?php $content = ob_get_clean(); ?>


<?php require('templateBlog.php'); ?>

