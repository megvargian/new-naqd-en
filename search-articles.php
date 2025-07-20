<?php
/**
 * Template Name: Search Articles
 */
get_header();
if(isset($_GET['searchArticle'])){
    $search_article = $_GET['searchArticle'];
}
$args = array(
    'post_type'      => 'post',
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
                            $count++;
                    ?>
                        <div class="col-lg-3 col-12 mb-2 px-1">
                            <a href="<?php echo get_permalink($article_id);?>" class="<?php echo $count > 8 ? 'fade-in' : ''?>">
                                <img class="w-100 d-block single-article " src="<?php echo $image_url; ?>" alt="<?php echo $article_title; ?>">
                            </a>
                        </div>
                    <?php
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