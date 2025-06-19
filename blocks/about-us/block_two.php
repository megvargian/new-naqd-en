<?php
/**
 * Block2 Block Template
 */
$block2_fields = get_fields();
?>
<div class="row mb-sm-5 mb-3">
    <div class="col-lg-4 col-12">
        <h2>
            <?php echo $block2_fields['title']; ?>
        </h2>
    </div>
    <div class="col-lg-8 col-12">
        <?php echo $block2_fields['paragraph']; ?>
    </div>
</div>