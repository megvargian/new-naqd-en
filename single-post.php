<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */
get_header();
$article_id = get_the_ID();
$title = get_the_title($article_id);
$get_article_fields = get_fields();
$author_id = $get_article_fields['author'];
$most_view_articles_top_five = get_top_5_most_visited('post');
// Get current post tags and categories
$tags = wp_get_post_tags( $article_id, array( 'fields' => 'ids' ) );
$get_assigned_tags = get_the_tags();
$categories = wp_get_post_categories($article_id);
// Build tax query
$tax_query = array( 'relation' => 'OR' );
if ( ! empty( $tags ) ) {
    $tax_query[] = array(
        'taxonomy' => 'post_tag',
        'field'    => 'term_id',
        'terms'    => $tags,
    );
}
if ( ! empty( $categories ) ) {
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => $categories,
    );
}
// Query related posts
$related_query = new WP_Query( array(
    'post_type'           => 'post',
    'posts_per_page'      => 6,
    'post__not_in'        => array( $post->ID ), // Exclude current post
    'ignore_sticky_posts' => true,
    'tax_query'           => $tax_query,
) );
//socail media share
$post_url   = urlencode(get_permalink($article_id));
$post_title = urlencode(get_the_title($article_id));
$post_image = wp_get_attachment_url(get_post_thumbnail_id($article_id));
?>
<section class="single-product-page">
    <div class="container">
        <div class="row justify-content-center pt-3">
            <div class="col-xxxl-5 col-xxl-4 col-lg-6 col-md-8 col-12">
                <img class="w-100 d-block main-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo $title; ?>">
                <div class="justify-content-between align-items-center lower-part py-2 w-100">
                    <div class="like-container">
                        <p class="helvetica-regular" dir="ltr">
                            <svg class="heart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" version="1.1" id="Capa_1" viewBox="0 0 471.701 471.701" xml:space="preserve" stroke="#fff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                <g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"/> </g> </g>
                                <script xmlns=""/>
                            </svg>
                            <svg class="heart-filled d-none" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 32 32" version="1.1" stroke="#fff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                <g id="SVGRepo_iconCarrier"> <title>heart-filled</title> <path d="M30.943 8.494c-0.816-2.957-3.098-5.239-5.994-6.040l-0.060-0.014c-0.651-0.159-1.399-0.25-2.169-0.25-2.624 0-5 1.062-6.722 2.779l0-0c-1.558-1.505-3.682-2.433-6.023-2.433-0.77 0-1.516 0.1-2.226 0.288l0.060-0.014c-3.104 0.882-5.499 3.277-6.365 6.317l-0.016 0.065c-0.171 0.648-0.269 1.393-0.269 2.16 0 2.588 1.117 4.915 2.896 6.525l0.008 0.007 11.381 12.619c0.138 0.153 0.336 0.248 0.557 0.248s0.419-0.095 0.556-0.247l0.001-0.001 11.369-12.605c2.002-1.789 3.256-4.379 3.256-7.261 0-0.759-0.087-1.498-0.252-2.208l0.013 0.066z"/> </g>
                                <script xmlns=""/>
                            </svg>
                        Like this post</p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="author-section">
                            <?php if (!empty(get_the_post_thumbnail_url($author_id))){ ?>
                                <a href="<?php echo get_permalink($author_id); ?>">
                                    <img class="" src="<?php echo get_the_post_thumbnail_url($author_id); ?>" alt="<?php echo get_the_title($author_id); ?>">
                                </a>
                            <?php } else {?>
                                <a href="<?php echo get_permalink($author_id); ?>">
                                    <img class="" src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/default-single-author-img.png" alt="<?php echo get_the_title($author_id); ?>">
                                </a>
                            <?php } ?>
                            <a href="<?php echo get_permalink($author_id); ?>">
                                <?php echo get_the_title($author_id); ?>
                            </a>
                        </div>
                        <p class="helvetica-regular" dir="ltr">
                            <?php echo get_the_date('j M Y', $article_id);?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-5">
            <div class="col-lg-8 col-10">
                <div id="theArticle">
                    <?php
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    ?>
                </div>
                <div class="py-5 tags">
                    <h3>Topics</h3>
                    <ul class="d-flex">
                        <?php foreach ( $get_assigned_tags as $tag ) {
                                $tag_link = get_tag_link( $tag->term_id );
                        ?>
                            <li>
                                <a href="<?php echo $tag_link; ?>">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-1 col-2">
                <div class="social-main">
                    <ul class="social-media-icons">
                        <li class="my-1">
                            <a href="https://www.instagram.com/naqdmedia/" target="_blank" rel="nofollow" class="single-social-icon">
                                <img class="active insta-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-active.svg" alt="insta">
								<img class="stroke insta-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-stroke.svg" alt="insta">
                            </a>
                        </li>
                        <li class="my-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" rel="nofollow" class="single-social-icon">
                                <img class="active fb-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-active.svg" alt="fb">
								<img class="stroke fb-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-stroke.svg" alt="fb">
                            </a>
                        </li>
                        <li class="my-1">
                            <a href="https://www.threads.net/share?text=<?php echo $post_url; ?>" class="single-social-icon">
								<img class="active threads-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-active.svg" alt="threads">
								<img class="stroke threads-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-stroke.svg" alt="threads">
                            </a>
                        </li>
                        <li class="my-1">
                            <a href="https://api.whatsapp.com/send?text=<?php echo $post_title . ' ' . $post_url; ?>" target="_blank" rel="nofollow" class="single-social-icon">
                                <img class="active whatsapp-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-active.svg" alt="whatsapp">
								<img class="stroke whatsapp-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-stroke.svg" alt="whatsapp">
                            </a>
                        </li>
                        <li class="my-1">
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" rel="nofollow" class="single-social-icon">
                                <img class="active x-active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-active.svg" alt="X">
								<img class="stroke x-stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-stroke.svg" alt="X">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="related-articles py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 border-right-white">
                    <div class="most-read-articles">
                        <h2 class="mb-3">
                            Most read
                        </h2>
                        <ul>
                            <?php foreach($most_view_articles_top_five as $post){
                                    $post_id = $post->ID;
                                    $get_fields = get_fields($post->ID);
                                    $author_id = $get_fields['author'];
                            ?>
                                <li>
                                    <a href="<?php echo get_permalink($post_id);?>">
                                        <h3 class="mb-2">
                                            <?php echo $post->post_title; ?>
                                        </h3>
                                    </a>
                                    <div class="author">
                                        <a href="<?php echo get_permalink($author_id); ?>">
                                            <?php echo get_the_title($author_id);?>
                                        </a>
                                        <div class="date helvetica-regular">
                                            <?php echo get_the_date('j M Y', $post_id);?>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="more custom-padding">
                        <h2 class="mb-3">
                            More
                        </h2>
                        <div class="row">
                            <?php if ( $related_query->have_posts() ) : ?>
                                <?php while ( $related_query->have_posts() ) : $related_query->the_post();
                                    $related_post_id = get_the_ID();
                                ?>
                                    <div class="col-lg-4 col-6 px-1 mb-4">
                                        <a href="<?php echo get_permalink($related_post_id); ?>">
                                            <img style="border-radius: 15px;" src="<?php echo get_the_post_thumbnail_url($related_post_id); ?>" alt="<?php get_the_title($related_post_id);?>" class="d-block w-100">
                                        </a>
                                    </div>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script>
    jQuery(document).ready(function($) {
        $(window).on('scroll resize', function () {
            const article = $('#theArticle');
            const articleTop = article.offset().top;
            const articleHeight = article.outerHeight();
            const scrollTop = $(window).scrollTop();
            const windowHeight = $(window).height();
            // How far through the article the user has scrolled
            const progress = Math.min(1, Math.max(0, (scrollTop + windowHeight - articleTop) / articleHeight));
            $('#progressBar').css('width', (progress * 100) + '%');
        });
    })
</script>
<?php
get_footer();
