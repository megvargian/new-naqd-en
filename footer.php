<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
$get_general_fields = get_fields('options');
$social_media_links = $get_general_fields['social_links'];
$main_menu = $get_general_fields['main_menu'];
?>
<footer class="pt-5">
    <div class="container">
        <div class="row pb-3">
            <div class="col-12 d-flex justify-content-end">
                <div id="scrollToTop" style="cursor: pointer;">
                    <img class="arrow-up" style="width: 35px;" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow-up-dark.svg" alt="arrow-up">
                </div>
            </div>
        </div>
        <div class="row justify-content-lg-between justify-content-end pb-4">
            <div class="col-lg-5 col-12 pb-lg-0 pb-4 justify-content-start d-flex align-items-center order-lg-1 order-0">
                <ul class="social-media-icons">
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['insta']; ?>" class="single-social-icon">
                            <img class="active insta-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-active.svg" alt="insta">
                            <img class="stroke insta-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-stroke.svg" alt="insta">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['facebook']; ?>" class="single-social-icon">
                            <img class="active fb-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-active.svg" alt="fb">
                            <img class="stroke fb-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-stroke.svg" alt="fb">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['linkedin']; ?>" class="single-social-icon">
                            <img class="active linkedin-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-active.svg" alt="linkedin">
                            <img class="stroke linkedin-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-stroke.svg" alt="linkedin">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['rss_feed']; ?>" class="single-social-icon">
                            <img class="active rss-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-active.svg" alt="RSS">
                            <img class="stroke rss-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-stroke.svg" alt="RSS">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['treads']; ?>" class="single-social-icon">
                            <img class="active threads-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-active.svg" alt="threads">
                            <img class="stroke threads-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-stroke.svg" alt="threads">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['tiktok']; ?>" class="single-social-icon">
                            <img class="active tiktok-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-active.svg" alt="tiktok">
                            <img class="stroke tiktok-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-stroke.svg" alt="tiktok">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['whatsapp']; ?>" class="single-social-icon">
                            <img class="active whatsapp-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-active.svg" alt="whatsapp">
                            <img class="stroke whatsapp-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-stroke.svg" alt="whatsapp">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['x']; ?>" class="single-social-icon">
                            <img class="active x-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-active.svg" alt="X">
                            <img class="stroke x-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-stroke.svg" alt="X">
                        </a>
                    </li>
                    <li class="mx-1">
                        <a href="<?php echo $social_media_links['youtube']; ?>" class="single-social-icon">
                            <img class="active youtube-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-active.svg" alt="youtube">
                            <img class="stroke youtube-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-stroke.svg" alt="youtube">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-1 col-4 pb-lg-0 pb-2 order-lg-0 order-1">
                <a href="<?php echo home_url(); ?>">
                    <img id="naqd_footer" class="w-100 d-block" src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/Naqd-logo-white.svg" alt="naqd">
                </a>
            </div>
        </div>
        <div class="row pb-3">
            <div class="col-12 pb-4">
                <ul class="footer-tags">
                    <?php foreach ($main_menu as $key => $menu_item) {?>
                        <li>
                            <a href="<?php echo $menu_item['url']; ?>">
                                <?php echo $menu_item['text']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-6 col-12 d-flex justify-content-start py-3">
                <a href="#">
                    <img class="d-block bell" style="width: 30px;" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/bell-dark.svg" alt="subscribe">
                </a>
            </div>
            <div class="col-lg-6 col-12">
                <div class="d-flex justify-content-end text-right align-items-center">
                    <p>Follow Naqd channel on YouTube</p>
                    <a class="button-green" style="height: fit-content;" href="#">
                        Subscribe
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="border-green"></div>
</footer>
</div><!-- #content -->
</div><!-- #page -->
<script>
    jQuery(document).ready(function($) {
        $('#scrollToTop').on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 600); // 600ms = smooth scroll
        });
    });
</script>
<?php wp_footer(); ?>
</body>
</html>