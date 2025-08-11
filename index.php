<?php
/**
 * Template Name: Homepage
 */
get_header();
$video_parts_ids = array();
$video_parts = new WP_Query(
    array(
        'post_type'      => 'video',
        'posts_per_page' =>  6,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'fields'         => 'ids',
    )
);
if ( $video_parts->have_posts() ) {
    while ( $video_parts->have_posts() ) {
        $video_parts->the_post();
        array_push($video_parts_ids, get_the_ID());
    }
    wp_reset_postdata();
}
$video_parts_chunks_ids = array_chunk($video_parts_ids, 2);
$get_homepage_fields = get_fields();
$count=0;
$top_posts = get_top_3_most_visited('post');
//slicing the latest posts base on the position
$main_part_ids = array();
$exclude_post_id_featured_article = isset($get_homepage_fields['featured_article']->ID)
    ? $get_homepage_fields['featured_article']->ID
    : (int) $get_homepage_fields['featured_article'];

$exclude_post_id_second_featured_article = isset($get_homepage_fields['second_feature_article']->ID)
    ? $get_homepage_fields['second_feature_article']->ID
    : (int) $get_homepage_fields['second_feature_article'];
$main_part = new WP_Query(
    array(
        'post_type'      => 'post',
        'posts_per_page' => 22,
        'post__not_in'   => array_filter([
            $exclude_post_id_featured_article,
            $exclude_post_id_second_featured_article
        ]),
        'orderby'        => 'date',
        'order'          => 'DESC',

    )
);
if ( $main_part->have_posts() ) {
    while ( $main_part->have_posts() ) {
        $main_part->the_post();
        array_push($main_part_ids, get_the_ID());
    }
    wp_reset_postdata();
}
$first_part = array_slice($main_part_ids, 0, 8);
$second_part = array_slice($main_part_ids, 8, 2);
$third_part = array_slice($main_part_ids, 10, 4);
$fourth_part = array_slice($main_part_ids, 14, 8);
?>
<section class="homepage">
    <div id="filter-container" class="container py-5">
        <?php
            if ( $get_homepage_fields['featured_article'] ) {
                $article_id = $get_homepage_fields['featured_article'];
                $get_all_feilds = get_fields($article_id);
                $author_id = $get_all_feilds['author'];
                $article_title = get_the_title($article_id);
                $image_url = get_the_post_thumbnail_url($article_id);
                // get the content
                $content = apply_filters('the_content', get_post_field('post_content', $article_id));
                $allowed_tags = '<p><a><strong><em><ul><ol><li><br>'; // Adjust as needed
                $clean_content = wp_strip_all_tags( strip_tags( $content, $allowed_tags ), true );
                $words = explode( ' ', $clean_content );
                $limited = implode( ' ', array_slice( $words, 0, 150 ) );
        ?>
            <div class="row bg-color-green mb-2">
                <div class="col-8 d-lg-flex d-none px-0 custom-border-radius" <?php if(!isMob()) {?>style="background-color: <?php echo $get_homepage_fields['background_color']; ?>" <?php } ?>>
                    <div class="d-flex justify-content-between align-items-center flex-column">
                        <div class="p-5 pb-0 text-left">
                            <p style="color: <?php echo $get_homepage_fields['text_color']; ?>">
                                <?php echo get_the_excerpt($article_id); ?>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center lower-part pb-5 px-5 w-100">
                            <div class="helvetica-regular" >
                                <p dir="ltr" style="color: <?php echo $get_homepage_fields['text_color']; ?>">
                                    <img class="heart" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/heart.svg" alt="heart">
                                    <img class="heart-filled d-none" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/heart-filled.svg" alt="heart">
                                    Like this post
                                </p>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="<?php echo get_permalink($author_id); ?>" style="color: <?php echo $get_homepage_fields['text_color']; ?>">
                                    <?php echo get_the_title($author_id);?>
                                </a>
                                <p class="helvetica-regular" dir="ltr" style="color: <?php echo $get_homepage_fields['text_color']; ?>">
                                    <?php echo get_the_date('j M Y', $article_id); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-12 mb-2 mb-sm-0 px-1 px-sm-0 position-relative">
                    <a href="<?php echo get_permalink($article_id); ?>">
                        <img class="w-100 h-100 d-block main-img" src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                        <img class="feature" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/feature-dark.png" alt="feature">
                    </a>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <?php
                foreach ($first_part as $key => $article_id) {
                    $article_title = get_the_title($article_id);
                    $image_url = get_the_post_thumbnail_url($article_id);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <a href="<?php echo get_permalink($article_id);?>" class="fade-in">
                        <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                    </a>
                </div>
            <?php }?>
        </div>
        <div class="row">
            <?php foreach($video_parts_chunks_ids[0] as $video_id){
                    $url = get_field('youtube_url', $video_id);
                    $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                    $parts = explode('/', $path);
                    $video_embed_id = end($parts);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <div class="openPopup fade-in" data-key="<?php echo $video_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                        <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo get_the_post_thumbnail_url($video_id);?>" alt="<?php echo get_the_title($video_id);?>">
                        <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                    </div>
                    <div class="overlay videoOverlay-<?php echo $video_id; ?>">
                        <div class="position-relative w-100 h-100">
                            <div class="popup">
                                <button class="close-btn" data-key="<?php echo $video_id; ?>">
                                    <span aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#fff"><path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/></svg>
                                    </span>
                                </button>
                                <iframe
                                        frameborder="0"
                                        width="360" height="640"
                                        allowfullscreen
                                        allow="autoplay; encrypted-media">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-6 col-12 mb-2 px-1">
                <div class="most-read-articles fade-in">
                    <h2 class="mb-3 mt-3 mb-lg-5 mt-lg-4">
                        Most read
                    </h2>
                    <ul>
                        <?php foreach($top_posts as $post){
                                $post_id = $post->ID;
                                $get_fields = get_fields($post->ID);
                                $author_id = $get_fields['author'];
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($post_id);?>">
                                    <h3>
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
        </div>
        <div class="row">
             <div class="col-lg-6 col-12">
                <div class="row">
                    <?php
                        foreach ($second_part as $key => $article_id) {
                            $article_title = get_the_title($article_id);
                            $image_url = get_the_post_thumbnail_url($article_id);
                    ?>
                        <div class="col-lg-6 col-12 mb-2 px-1">
                            <a href="<?php echo get_permalink($article_id);?>" class="fade-in">
                                <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-12 mb-2 px-1">
                        <div class="subscribe" class="fade-in">
                            <h4>To receive the Criticism newsletter in your email</h4>
                            <form  action="/">
                                <input class="email" type="email" placeholder="Your email" required>
                                <button class="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach($video_parts_chunks_ids[1] as $video_id){
                    $url = get_field('youtube_url', $video_id);
                    $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                    $parts = explode('/', $path);
                    $video_embed_id = end($parts);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <div class="openPopup fade-in" data-key="<?php echo $video_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                        <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo get_the_post_thumbnail_url($video_id);?>" alt="<?php echo get_the_title($video_id);?>">
                        <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                    </div>
                    <div class="overlay videoOverlay-<?php echo $video_id; ?>">
                        <div class="position-relative w-100 h-100">
                            <div class="popup">
                                <button class="close-btn" data-key="<?php echo $video_id; ?>">
                                    <span aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#fff"><path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/></svg>
                                    </span>
                                </button>
                                <iframe
                                        frameborder="0"
                                        width="360" height="640"
                                        allowfullscreen
                                        allow="autoplay; encrypted-media">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php foreach ($third_part as $key => $article_id) {
                    $article_title = get_the_title($article_id);
                    $image_url = get_the_post_thumbnail_url($article_id);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <a href="<?php echo get_permalink($article_id);?>" class="fade-in">
                        <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="row parent-row-rassif">
            <div class="col-lg-6 col-12 mb-2 px-1">
                <?php $second_feature_title = get_the_title($get_homepage_fields['second_feature_article']); ?>
                <div class="rassif-section fade-in">
                    <img class="w-100 d-block" src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/rassif-2.jpg" alt="rassif">
                    <div class="title title-padding">
                        <h2><?php echo $second_feature_title; ?></h2>
                    </div>
                    <?php  if(!isMob()){?>
                        <div class="rassif-description">
                            <div class="px-4">
                                <h2 class="mb-3"><?php echo $second_feature_title; ?></h2>
                                <p class="mb-3"><?php echo $get_homepage_fields['description'];?></p>
                                <a href="<?php echo get_permalink($get_homepage_fields['second_feature_article']); ?>">More</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php foreach($video_parts_chunks_ids[2] as $video_id){
                    $url = get_field('youtube_url', $video_id);
                    $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                    $parts = explode('/', $path);
                    $video_embed_id = end($parts);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <div class="openPopup fade-in" data-key="<?php echo $video_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                        <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo get_the_post_thumbnail_url($video_id);?>" alt="<?php echo get_the_title($video_id);?>">
                        <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                    </div>
                    <div class="overlay videoOverlay-<?php echo $video_id; ?>">
                        <div class="position-relative w-100 h-100">
                            <div class="popup">
                                <button class="close-btn" data-key="<?php echo $video_id; ?>">
                                    <span aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#fff"><path d="M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z"/></svg>
                                    </span>
                                </button>
                                <iframe
                                        frameborder="0"
                                        width="360" height="640"
                                        allowfullscreen
                                        allow="autoplay; encrypted-media">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php foreach ($fourth_part as $key => $article_id) {
                    $article_title = get_the_title($article_id);
                    $image_url = get_the_post_thumbnail_url($article_id);
            ?>
                <div class="col-lg-3 col-12 mb-2 px-1">
                    <a href="<?php echo get_permalink($article_id);?>" class="fade-in">
                        <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="row pt-lg-5 pt-3">
            <div class="col-12 mb-3 text-right">
                <h2>
                    LATEST NEWS
                </h2>
            </div>
            <!-- <div class="col-12 position-relative">
                <div class="swiper latestNewsSwiper">
                    <div class="swiper-wrapper">
                        <?php //for($i=0; $i<8; $i++){ ?>
                            <div class="swiper-slide">
                                <a href="#" class="fade-in">
                                    <img class="w-100 d-block single-article " src="<?php //echo get_template_directory_uri(); ?>/inc/assets/images/berry.jpg" alt="berry">
                                </a>
                            </div>
                        <?php //} ?>
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-prev-latest-article"></div>
            </div> -->
            <div class="col-12">
                <?php echo do_shortcode('[instagram-feed feed=1]');?>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function($) {
        // var swiper = new Swiper(".latestNewsSwiper", {
        //     slidesPerView: 4,
        //     spaceBetween: 10,
        //     grabCursor: true,
        //     loop: true,
        //     navigation: {
        //         nextEl: ".swiper-button-prev",
        //     },
        //     breakpoints: {
		// 		// when window width is >= 320px
		// 		320: {
		// 			slidesPerView: 1.5,
		// 			spaceBetween: 10,
		// 		},
		// 		// when window width is >= 480px
		// 		480: {
		// 			slidesPerView: 1.5,
		// 			spaceBetween: 10,
		// 		},
		// 		// when window width is >= 640px
		// 		640: {
		// 			slidesPerView: 2,
		// 			spaceBetween: 10,
		// 		},
		// 		991: {
		// 			slidesPerView: 4,
		// 			spaceBetween: 10,
		// 		}
		// 	}
        // });
        // swiper.changeLanguageDirection('rtl');
        $('.heart').click(function(){
            $(this).addClass('d-none');
            $('.heart-filled').removeClass('d-none');
        });
        $('.heart-filled').click(function(){
            $(this).addClass('d-none');
            $('.heart').removeClass('d-none');
        });
        $('.openPopup').click(function(){
            let key = $(this).attr('data-key');
            let embedKey = $(this).attr('data-key-url');
            <?php if(isMob()){ ?>
                window.location.href = 'https://www.youtube.com/embed/'+embedKey+'?autoplay=1';
            <?php } else { ?>
                $('.videoOverlay-' + key).css('display', 'block');
                $('.videoOverlay-' + key).find('iframe').attr('src', 'https://www.youtube.com/embed/'+embedKey+'?autoplay=1');
		        $('html, body').addClass('hide_scroll');
            <?php } ?>
            //add counter in db
            addCounterViewForVideo(key);
        });
        $('.close-btn').click(function(){
            var key = $(this).attr('data-key');
            $('.videoOverlay-' + key).css('display', 'none');
            $('.videoOverlay-' + key).find('iframe').attr('src', '');
		    $('html, body').removeClass('hide_scroll');
        });
        function addCounterViewForVideo(videoId) {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'add_counter_view_video',
                    id: videoId,
                },
                success: function(response) {
                    console.log('view', videoId)
                },
                error: function(error) {
                    console.error(error)
                },
            });
        }
        <?php if(!isMob()){ ?>
            // for rassif
            $('.rassif-section').on('mouseenter', function() {
                $(this).find('img').addClass('h-100');
                $(this).addClass('active');
                const parentWidth = $('.parent-row-rassif').width() - 8;
                const parentHeight = $('.parent-row-rassif').height();

                // Apply styles on hover
                $(this).css({
                    'z-index': 10,
                    'width': parentWidth,
                    'height': parentHeight,
                });

                // Hide inner .title
                $(this).find('.title').css('opacity', 0);
                $(this).find('.title').css('z-index', '-1');
                setTimeout(() => {
                    $(this).find('.title').css('display', 'none');
                    $(this).find('.rassif-description').css({
                        'bottom': '5%',
                        'opacity': '1',
                        'z-index': '10',
                        'visibility': 'visible'
                    })
                }, 300);
            });
            $('.rassif-section').on('mouseleave', function() {
                // Reset styles (optional – adjust as needed)
                $(this).find('img').removeClass('h-100');
                $(this).removeClass('active');
                $(this).find('.rassif-description').css({
                    'bottom': '-5%',
                    'opacity': '0',
                    'z-index': '-1',
                    'visibility': 'hidden'
                })
                setTimeout(() => {
                    $(this).find('.title').css('display', 'block');
                }, 300);
                $(this).css({
                    'z-index': '',
                    'width': '',
                    'height': ''
                });

                // Show .title again
                $(this).find('.title').css('opacity', 1);
                $(this).find('.title').css('z-index', '1');
            });
        <?php } else { ?>
            $('.rassif-section').click(function(){
                window.location.href = '<?php echo get_permalink($get_homepage_fields['second_feature_article']); ?>';
            })
        <?php } ?>
    })
</script>
<?php
get_footer();