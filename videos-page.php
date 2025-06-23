<?php
/**
 * Template Name: Videos Page
 */
get_header();
$get_video_fields = get_fields();
$video_parts_ids = array();
$video_parts = new WP_Query(
    array(
        'post_type'      => 'video',
        'posts_per_page' =>  14,
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
}
$first8 = array_slice($video_parts_ids, 0, 8);
$next2  = array_slice($video_parts_ids, 8, 2);
$next4  = array_slice($video_parts_ids, 10, 4);
$top_videos = get_top_3_most_visited('video');
?>
<section class="categories">
    <div class="container">
        <div class="row py-4 position-relative">
            <div class="swiper MainCatVideo">
                <div class="swiper-wrapper">
                    <?php foreach ($get_video_fields['featured_videos'] as $key => $video) {
                        $video_id = $video['video'];
                        $image_url = get_the_post_thumbnail_url($video_id);
                        $title = get_the_title($video_id);
                        $url = get_field('youtube_url', $video_id);
                        $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                        $parts = explode('/', $path);
                        $video_embed_id = end($parts);
                    ?>
                        <div class="swiper-slide">
                            <div class="openPopup fade-in" data-key="<?php echo $video_id; ?>"  data-key-url="<?php echo $video_embed_id; ?>">
                                <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>">
                                <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="swiper-button-prev swiper-button-prev-main-cat"></div>
            <div class="swiper-button-next swiper-button-next-main-cat"></div>
        </div>
        <?php foreach ($get_video_fields['featured_videos'] as $key => $video) {
                $video_id = $video['video'];
        ?>
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
        <?php } ?>
        <div class="row py-4 " style="border-top: 1px solid #5b5b5b">
            <ul class="d-flex justify-content-start align-items-center tabs">
                <?php foreach ($get_video_fields['tags'] as $key => $tag) {
                ?>
                    <li>
                        <button class="single-video-tag tag-<?php echo $tag->term_id ?>" data-tagId="<?php echo $tag->term_id ?>">
                            <?php echo esc_html( $tag->name ); ?>
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="video-filter-container" class="row">
            <?php foreach ($first8 as $key => $video_id) {
                $url = get_field('youtube_url', $video_id);
                $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                $parts = explode('/', $path);
                $video_embed_id = end($parts);
            ?>
                <div class="col-lg-3 col-12 mb-3 px-2">
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
        <div class="row hide-on-filter">
            <div class="col-lg-6 col-12 mb-3 px-2">
                <div class="most-read-articles fade-in">
                    <h2 class="mb-3 mt-3 mb-lg-5 mt-lg-4">
                        Most viewed
                    </h2>
                    <ul>
                        <?php foreach($top_videos as $video){
                                $video_id = $video->ID;
                                $url = get_field('youtube_url', $video_id);
                                $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                                $parts = explode('/', $path);
                                $video_embed_id = end($parts);
                        ?>
                            <li>
                                <h3 class="openPopupMostView" style="cursor: pointer;" data-key="<?php echo $video_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                                    <?php echo $video->post_title; ?>
                                </h3>
                                <div class="author">
                                    <div class="date helvetica-regular">
                                        <?php echo get_the_date('j M Y', $post_id);?>
                                    </div>
                                </div>
                            </li>
                            <div class="overlay videoOverlayMostView-<?php echo $video_id; ?>">
                                <div class="position-relative w-100 h-100">
                                    <div class="popup">
                                        <button class="close-btnMostView" data-key="<?php echo $video_id; ?>">
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
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="row">
                    <?php foreach ($next2 as $key => $video_id) {
                            $url = get_field('youtube_url', $video_id);
                            $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                            $parts = explode('/', $path);
                            $video_embed_id = end($parts);
                        ?>
                        <div class="col-lg-6 col-12 mb-3 px-2">
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
            </div>
        </div>
        <div class="row hide-on-filter">
            <?php foreach ($next4 as $key => $video_id) {
                    $url = get_field('youtube_url', $video_id);
                    $path = parse_url($url, PHP_URL_PATH); // "/embed/UqI3exV3YPM"
                    $parts = explode('/', $path);
                    $video_embed_id = end($parts);
                ?>
                <div class="col-lg-3 col-12 mb-3 px-2">
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
        <div class="row pt-3">
                <div class="col-12 mb-3 text-right">
                    <h2>
                        Latest news
                    </h2>
                </div>
                <div class="col-12 position-relative">
                    <div class="swiper latestNewsSwiper">
                        <div class="swiper-wrapper">
                            <?php for($i=0; $i<8; $i++){ ?>
                                <div class="swiper-slide">
                                    <a href="#" class="fade-in">
                                        <img class="w-100 d-block single-article " src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/berry.jpg" alt="berry">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-prev-latest-article"></div>
                </div>
            </div>
        </div>
</section>
<script>
    jQuery(document).ready(function($) {
        var swiper = new Swiper(".latestNewsSwiper", {
            slidesPerView: 4,
            spaceBetween: 16,
            grabCursor: true,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-prev",
            },
            breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1.5,
					spaceBetween: 10,
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 1.5,
					spaceBetween: 10,
				},
				// when window width is >= 640px
				640: {
					slidesPerView: 2,
					spaceBetween: 10,
				},
				991: {
					slidesPerView: 4,
					spaceBetween: 16,
				}
			}
        });
        swiper.changeLanguageDirection('rtl');
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
        // for most view videos
        $('.openPopupMostView').click(function(){
            let key = $(this).attr('data-key');
            let embedKey = $(this).attr('data-key-url');
            <?php if(isMob()){ ?>
                window.location.href = 'https://www.youtube.com/embed/'+embedKey+'?autoplay=1';
            <?php } else { ?>
                $('.videoOverlayMostView-' + key).css('display', 'block');
                $('.videoOverlayMostView-' + key).find('iframe').attr('src', 'https://www.youtube.com/embed/'+embedKey+'?autoplay=1');
		        $('html, body').addClass('hide_scroll');
            <?php } ?>
            //add counter in db
            addCounterViewForVideo(key);
        });
         $('.close-btnMostView').click(function(){
            var key = $(this).attr('data-key');
            $('.videoOverlayMostView-' + key).css('display', 'none');
            $('.videoOverlayMostView-' + key).find('iframe').attr('src', '');
		    $('html, body').removeClass('hide_scroll');
        });
        var swiperMainCat = new Swiper(".MainCatVideo", {
            slidesPerView: 4,
            spaceBetween: 16,
            grabCursor: true,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-prev-main-cat",
                prevEl: ".swiper-button-next-main-cat",
            },
            breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1.5,
					spaceBetween: 10,
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 1.5,
					spaceBetween: 10,
				},
				// when window width is >= 640px
				640: {
					slidesPerView: 2,
					spaceBetween: 10,
				},
				991: {
					slidesPerView: 4,
					spaceBetween: 16,
				}
			}
        });
        swiper.changeLanguageDirection('rtl');
        $('.single-video-tag').click(function() {
            $(this).toggleClass('active');
            var activeTags = [];
            $('.single-video-tag.active').each(function() {
                activeTags.push($(this).attr('data-tagId'));
            });
            console.log(activeTags)
            if(activeTags.length !== 0){
                filterVideosBasedTags(activeTags);
            } else {
                window.location.href = '<?php echo get_permalink(86); ?>';
            }
        });
        function filterVideosBasedTags(activeTags) {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'filter_videos_based_tags',
                    videoTags: activeTags,
                },
                success: function(response) {
                    if (response === ''){
                        // $('#load-more-button-cat').hide();
                    }
                    if (response) {
                        $('#video-filter-container').replaceWith(response);
                        $('.hide-on-filter').hide();
                    } else {
                        // No more posts to load
                        // $('#load-more-button-cat').hide();
                    }
                },
            });
	    }
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
    });
</script>
<?php
get_footer();