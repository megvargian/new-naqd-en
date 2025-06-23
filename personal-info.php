<?php
/**
 * Template Name: Personal Info
 */
get_header();
?>
<section class="personal-info py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-12">
                <div class="row justify-content-start">
                    <div class="col-lg-8 col-12">
                        <div class="form_validation_parent position-relative">
                            <?php echo do_shortcode('[contact-form-7 id="2f3ec12" title="Personal info"]') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function($) {
        $('input[name="url-625"]').attr('hidden', true);
        $('input[value="No"]').click(function(event) {
            $('input[name="url-625"]').attr('hidden', true);
        });
        $('input[value="Yes"]').click(function(event) {
            $('input[name="url-625"]').attr('hidden', false);
        });
        $('input').on('click', function(e) {
            if ($(this).attr('type') !== 'submit' && $(this).attr('type') !== 'button' && $(this).attr('type') !== 'radio') {
                e.preventDefault(); // prevent submission
            }
        });
    });
</script>
<?php
get_footer();