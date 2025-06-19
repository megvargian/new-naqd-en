<?php
/**
 * Block1 Block Template
 */
$block1_fields = get_fields();
?>
<div class="row mb-sm-5 mb-3">
    <div class="col-lg-4 col-12">
        <p class="bold">
            <?php echo $block1_fields['bold_text'];?>
        </p>
    </div>
    <div class="col-lg-8 col-12">
        <?php echo $block1_fields['paragraph']; ?>
    </div>
</div>