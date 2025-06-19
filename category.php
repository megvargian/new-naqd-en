<?php
get_header();
$category = get_queried_object();
$query = new WP_Query(
    array(
        'post_type'      => 'post',
        'posts_per_page' =>  -1,
        'cat'            => $category->term_id,
        'orderby'        => 'date',
        'order'          => 'DESC',
    )
);
?>
<section class="homepage">
    <div class="container">
        <div class="row text-center pt-4">
            <h1><?php single_cat_title(); ?></h1>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <?php
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    $article_id = get_the_ID();
                    $article_title = get_the_title($article_id);
                    $image_url = get_the_post_thumbnail_url($article_id);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <a href="<?php echo get_permalink($article_id);?>" class="fade-in">
                        <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                    </a>
                </div>
            <?php }
                wp_reset_postdata();
            }?>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function($) {
    })
</script>
<?php
get_footer();