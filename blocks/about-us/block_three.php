<?php
/**
 * Block3 Block Template
 */
$block3_fields = get_fields();
?>
<div class="row mb-sm-5 mb-3 justify-content-between">
    <?php foreach ($block3_fields['profiles'] as $key => $profile) {?>
        <div class="col-lg-3 col-12">
            <div class="members">
                <img class="w-100" src="<?php echo $profile['image']; ?>" alt="<?php echo $profile['title']; ?>">
                <h3><?php echo $profile['title']; ?></h3>
                <p><?php echo $profile['sub_title']; ?></p>
            </div>
        </div>
    <?php } ?>
</div>