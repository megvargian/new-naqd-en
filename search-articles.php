<?php
/**
 * Template Name: Search Articles
 */
get_header();
if(isset($_GET['searchArticle'])){
    $search_article = $_GET['searchArticle'];
}
$args = array(
    'post_type'      => array('post', 'video'),
    'posts_per_page' =>  8,
    'orderby'        => 'date',
    'order'          => 'DESC',
);
$query = new WP_Query($args);
// Get all categories
$categories = get_categories(array(
    'hide_empty' => true
));
// // Get all tags
// $tags = get_tags(array(
//     'hide_empty' => true
// ));
$get_general_fields = get_fields('options');
$tags = $get_general_fields['tags'];
?>
<section class="position-relative search-articles" style="z-index: 1;">
    <section class="products-cats pb-sm-5 pb-3">
        <section class="bg-gray mt-4">
            <div class="container bg-gray">
                <div class="row justify-content-start pt-5 pb-2">
                    <div class="col-lg-6 col-12">
                        <form class="search-form-filter">
                            <div class="d-flex justify-content-center align-items-center">
                                <input placeholder="بحث" name="search" type="search" required class="search">
                                <button type="submit">
                                    <img class="submit-img" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow_green.svg" alt="search">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center pb-5">
                    <div class="col-lg-12 col-12">
                        <div class="pb-3">
                            <div class="filter-products py-3" style="color: #fff;">
                                <ul class="filter-list">
                                    <?php //foreach ($categories as $category): ?>
                                        <!-- <li>
                                            <button class="single-filter-cat cat-<?php // echo esc_attr($category->term_id); ?>" data-catId="<?php // echo esc_attr($category->term_id); ?>">
												<?php // echo esc_html($category->name); ?>
											</button>
                                        </li> -->
                                    <?php //endforeach; ?>
                                    <li>
                                        <div class="date-container" onclick="document.getElementById('filter_date').showPicker()">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v14a2
                                                2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM5
                                                20V9h14v11H5z"/>
                                            </svg>
                                            <span class="label">Date</span>
                                            <input type="date" id="filter_date" name="filter_date">
                                        </div>
                                    </li>
                                    <?php foreach ($tags as $tag): ?>
                                        <li>
                                            <button class="single-filter-tag tag-<?php echo esc_attr($tag->term_id); ?>" data-tagId="<?php echo esc_attr($tag->term_id); ?>">
												<?php echo esc_html($tag->name); ?>
											</button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div id="filter-container" class="row">
                    <?php
                        if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $article_id = get_the_ID();
                            $article_title = get_the_title($article_id);
                            $image_url = get_the_post_thumbnail_url($article_id);
                            $post_type = get_post_type($article_id);
                            $count++;

                            if ($post_type == 'video') {
                                $url = get_field('youtube_url', $article_id);
                                $path = parse_url($url, PHP_URL_PATH);
                                $parts = explode('/', $path);
                                $video_embed_id = end($parts);
                    ?>
                        <div class="col-lg-3 col-12 mb-2 px-1">
                            <div class="openPopup <?php echo $count > 8 ? 'fade-in' : ''?>" data-key="<?php echo $article_id; ?>" data-key-url="<?php echo $video_embed_id; ?>">
                                <img class="w-100 d-block single-article-video" style="cursor: pointer;" src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                                <img class="arrow-play" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/play.ico" alt="play">
                            </div>
                            <div class="overlay videoOverlay-<?php echo $article_id; ?>">
                                <div class="position-relative w-100 h-100">
                                    <div class="popup">
                                        <button class="close-btn" data-key="<?php echo $article_id; ?>">
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
                    <?php
                            } else {
                    ?>
                        <div class="col-lg-3 col-12 mb-2 px-1">
                            <a href="<?php echo get_permalink($article_id);?>" class="<?php echo $count > 8 ? 'fade-in' : ''?>">
                                <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                            </a>
                        </div>
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <div class="row text-center">
                    <button id="load-more-button" class="main-btn button-green-view-more helvetica-regular" style="width: fit-content; margin: auto;">
                        View more
                    </button>
                </div>
            </div>
        </div>
    </section>
</section>
<script>
    jQuery(document).ready(function($) {
        // Video popup functionality
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

        // Date filter
        $('input[type="date"]').on('change', function() {
            var activeCats = [];
            var activeTags = [];
            $('.single-filter-cat.active').each(function() {
                activeCats.push($(this).attr('data-catId'));
            });
            $('.single-filter-tag.active').each(function() {
                activeTags.push($(this).attr('data-tagId'));
            });
            var search = $('.search').val();
            var filterDate = $('#filter_date').val();
            searchResults(activeCats, activeTags, search, filterDate);
        });
        $('.single-filter-cat').click(function() {
            $(this).toggleClass('active');
            var activeCats = [];
            var activeTags = [];
            $('.single-filter-cat.active').each(function() {
                activeCats.push($(this).attr('data-catId'));
            });
            $('.single-filter-tag.active').each(function() {
                activeTags.push($(this).attr('data-tagId'));
            });
            var search = $('.search').val();
            searchResults(activeCats, activeTags, search);
        });
        $('.single-filter-tag').click(function() {
            $(this).toggleClass('active');
            var activeCats = [];
            var activeTags = [];
            $('.single-filter-cat.active').each(function() {
                activeCats.push($(this).attr('data-catId'));
            });
            $('.single-filter-tag.active').each(function() {
                activeTags.push($(this).attr('data-tagId'));
            });
            var search = $('.search').val();
            searchResults(activeCats, activeTags, search);
        });
        $('.search-form-filter').submit(function(e) {
            e.preventDefault();
            var activeCats = [];
            var activeTags = [];
            $('.single-filter-cat.active').each(function() {
                activeCats.push($(this).attr('data-catId'));
            });
            $('.single-filter-tag.active').each(function() {
                activeTags.push($(this).attr('data-tagId'));
            });
            var search = $('.search').val();
            searchResults(activeCats, activeTags, search);
        });
        function searchResults(selectedCategories, selectedTags, search, filterDate) {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'load_filtered_articles',
                    selectedCategories: selectedCategories,
                    selectedTags: selectedTags,
                    search: search,
                    date: filterDate,
                },
                success: function(response) {
                    if (response) {
                        $('#filter-container').replaceWith(response);
                        $('#load-more-button').hide();
                    }
                },
            });
        }
        <?php if($search_article){ ?>
            $('.search').val("<?php echo $search_article; ?>");
            $('.search-form-filter').submit();
        <?php } ?>
        var page = 1; // Set the initial page number
        // Function to load more posts via AJAX
        function loadMorePosts() {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'load_more_products',
                    page: page,
                },
                success: function(response) {
                    if (response === ''){
                        $('#load-more-button').hide();
                    }
                    if (response) {
                        $('#filter-container').append(response);
                        page++;
                    } else {
                        // No more posts to load
                        $('#load-more-button').hide();
                    }
                },
            });
        }
        // Trigger the AJAX call when the button is clicked
        $('#load-more-button').click(function() {
            loadMorePosts();
        });
    });
</script>
<?php
get_footer();