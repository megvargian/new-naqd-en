<?php
/**
 * Template Name: contact us
 */
get_header();
?>
<section class="contact-us">
    <div class="position-relative">
        <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/about-us.jpg" alt="about us">
        <div class="title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="container py-md-5 py-3">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="row w-100 py-md-5 py-3" style="padding-left: 1rem;">
                    <div class="col-12 pt-md-5 pt-3">
                        <?php
                            while ( have_posts() ) : the_post();
                                the_content();
                            endwhile;
                        ?>
                    </div>
                </div>
                <div class="row pb-md-3 pb-0">
                    <div class="col-12 text-left">
                        <h3>Get in touch</h3>
                        <div class="border-org"></div>
                    </div>
                </div>
                <div class="row py-md-5 py-2">
                    <div class="col-12 text-center">
                        <h2>Send a message to our team of experts</h2>
                    </div>
                </div>
                <!-- <form action="/">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="firstName">
                                    First Name:*
                                </label>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="company">
                                    Company:*
                                </label>
                                <input type="text" id="company" name="company" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="lastName">
                                    Last Name:*
                                </label>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="country">
                                    Country:*
                                </label>
                                <input type="text" id="country" name="country" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="phoneNumber">
                                    Phone Number:*
                                </label>
                                <input type="tel" id="phoneNumber" name="phoneNumber" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="email">
                                    Email:*
                                </label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div>
                                <label for="email">
                                    Type of inquiry:
                                </label>
                                <input type="text" id="inquiry" name="inquiry">
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <label for="message">
                                    Your Message
                                </label>
                                <textarea name="message" id="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 px-4 d-flex justify-content-start">
                            <input type="checkbox" name="policy" required>
                            <label class="mb-0" for="policy">
                                I agree to submit my details. I have read and understood the <a href="#">Privacy Policy</a>*
                            </label>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-md-end justify-content-center">
                            <button type="submit">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form> -->
                <div class="form_validation_parent position-relative">
                    <?php echo do_shortcode('[contact-form-7 id="9f98b0c" title="Contact Form"]') ?>
                    <div class="contact_success_message">
                        <?php //echo __('All right reserved Your message has been sent and we will contact you as soon as possible. Thank you!', 'contactuspage')?>
                    </div>
                    <div class="contact_fail_message">
                        <?php //echo __('An error has occurred. Please try again!', 'contactuspage')?>
                    </div>
                    <div class="swiper-pagination swiper-mobile-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
jQuery(document).ready(function($) {
    var cf7form = $('.wpcf7');
    if (cf7form) {
        $(cf7form).each(function(index, el) {
            if (el) {
                $(el).find('form').submit(function(event) {
                    $(el).find('form').find('.wpcf7-submit').addClass('disabled');
                    $(el).parents('.form_validation_parent').find('.contact_success_message').hide();
                    $(el).parents('.form_validation_parent').find('.contact_fail_message').hide();
                });
                el.addEventListener( 'wpcf7mailsent', function( event ) {
                    $(el).parents('.form_validation_parent').find('.contact_success_message').slideDown(300);
                    $(el).parents('.form_validation_parent').find('.wpcf7-response-output').slideDown(300);

                }, false );
                el.addEventListener( 'wpcf7mailfailed', function( event ) {
                    $(el).find('form').find('.wpcf7-submit').removeClass('disabled');
                    $(el).parents('.form_validation_parent').find('.contact_fail_message').slideDown(300);
                }, false );
                el.addEventListener( 'wpcf7spam', function( event ) {
                    $(el).find('form').find('.wpcf7-submit').removeClass('disabled');
                    $(el).parents('.form_validation_parent').find('.contact_fail_message').slideDown(300);
                }, false );
                el.addEventListener( 'wpcf7invalid', function( event ) {
                    $(el).find('form').find('.wpcf7-submit').removeClass('disabled');
                    $(el).parents('.form_validation_parent').find('.contact_fail_message').slideDown(300);
                }, false );
            }
        });
    }
});
</script>
<?php
get_footer();