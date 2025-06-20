<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */
$get_general_fields = get_fields('options');
$tags = $get_general_fields['tags'];
$social_media_links = $get_general_fields['social_links'];
// get all cats and tags
// $all_categories = get_categories( array(
//     'hide_empty' => false, // Set to true to exclude empty categories
// ));
$all_tags = get_tags( array(
    'hide_empty' => false, // Set to true to exclude tags with no posts
) );
// $length_cats_array = count($all_categories);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/theme-toggles@4.10.1/css/classic.min.css">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
	<style>
		<?php
			foreach ( $tags as $key => $tag ) {
		?>
			.header-container .tag-list li:nth-child(<?php echo $key + 1; ?>) button:hover{
				border-color: <?php echo get_field('border_color', 'post_tag_' . $tag->term_id);?>;
			}
			.header-container .tag-list li:nth-child(<?php echo $key + 1; ?>) button.active{
				border-color: <?php echo get_field('border_color', 'post_tag_' . $tag->term_id);?>;
			}
		<?php } ?>
		<?php
			//foreach ( $all_categories as $key => $cat ) {
		?>
			/* .search-articles .filter-list li:nth-child(<?php //echo $key + 1; ?>) button:hover{
				border-color: <?php //echo get_field('border_color', 'category_' . $cat->term_id);?>;
			}
			.search-articles .filter-list li:nth-child(<?php //echo $key + 1; ?>) button.active{
				border-color: <?php //echo get_field('border_color', 'category_' . $cat->term_id);?>;
			} */
		<?php // } ?>
		<?php
			foreach ( $all_tags as $key => $tag ) {
				//$tag_count = $length_cats_array + 1;
		?>
			.search-articles .filter-list  .tag-<?php echo $tag->term_id; ?>:hover{
				border-color: <?php echo get_field('border_color', 'post_tag_' . $tag->term_id);?>;
			}
			.search-articles .filter-list .tag-<?php echo $tag->term_id; ?>.active{
				border-color: <?php echo get_field('border_color', 'post_tag_' . $tag->term_id);?>;
			}
		<?php //$tag_count++;
		} ?>
	</style>
</head>
<body <?php body_class(); ?>>
<div class="transparent-black-overlay d-none"></div>
<div id="page" class="site main_page_wrapper">
	<?php if(is_singular('post')){ ?>
		<div id="progressBarContainer">
			<div id="progressBar"></div>
		</div>
	<?php } ?>
	<header id="masthead" class="header-container py-3">
		<nav>
			<div class="container-fluid px-4">
				<div class="row">
					<div class="col d-flex justify-content-end align-items-center">
						<button class="hamburger hamburger--collapse" type="button">
							<div class="menu_mobile_nav">
								<div class="hamburger_menu_icon">
									<div class="line"></div>
									<div class="line middle_line"></div>
									<div class="line"></div>
								</div>
							</div>
						</button>
						<label class="switch">
							<input type="checkbox" id="changeTheme">
							<span class="slider">
								<span class="label-text EN helvetica-regular">En</span>
								<span class="label-text AR d-none helvetica-regular">Ar</span>
							</span>
						</label>
					</div>
					<div class="col-9 justify-content-<?php echo is_page('search-articles') || is_page('videos') ? 'start' : 'center';  ?> d-lg-flex d-none align-items-center">
						<div class="d-block">
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
							<?php if(!is_page('search-articles') && !is_page('videos')){ ?>
								<nav class="d-block mt-2">
									<ul class="d-flex justify-content-start align-items-center tag-list">
										<?php
											foreach ( $tags as $tag ) {
										?>
												<li>
													<button class="single-tag tag-<?php echo $tag->term_id ?>" data-tagId="<?php echo $tag->term_id ?>">
														<?php echo esc_html( $tag->name ); ?>
													</button>
												</li>
										<?php } ?>
									</ul>
								</nav>
							<?php } ?>
						</div>
					</div>
					<div class="col d-flex justify-content-start">
						<a href="<?php echo home_url(); ?>">
							<img id="logo" class="logo d-block" src="<?php echo get_template_directory_uri(); ?>/inc/assets/images/Naqd-logo-white.svg" alt="naqd">
						</a>
					</div>
				</div>
			</div>
			<div id="menu_mobile" class="menu_on_mobile">
				<div class="menu_on_mobile_wrapper">
					<div class="menu_on_mobile_inner_wrapper" style="position: relative;">
						<label id="toggle-change" class="theme-toggle" title="Toggle theme">
							<input type="checkbox" checked />
							<span class="theme-toggle-sr">Toggle theme</span>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								aria-hidden="true"
								width="1em"
								height="1em"
								fill="currentColor"
								stroke-linecap="round"
								class="theme-toggle__classic"
								viewBox="0 0 32 32"
							>
								<clipPath id="theme-toggle__classic__cutout">
								<path d="M0-5h30a1 1 0 0 0 9 13v24H0Z" />
								</clipPath>
								<g clip-path="url(#theme-toggle__classic__cutout)">
								<circle cx="16" cy="16" r="9.34" />
								<g stroke="currentColor" stroke-width="1.5">
									<path d="M16 5.5v-4" />
									<path d="M16 30.5v-4" />
									<path d="M1.5 16h4" />
									<path d="M26.5 16h4" />
									<path d="m23.4 8.6 2.8-2.8" />
									<path d="m5.7 26.3 2.9-2.9" />
									<path d="m5.8 5.8 2.8 2.8" />
									<path d="m23.4 23.4 2.9 2.9" />
								</g>
								</g>
							</svg>
						</label>
						<div class="search-form">
							<form action="/search-articles">
								<div class="position-relative">
									<input placeholder="بحث" type="search" required name="searchArticle">
									<button>
										<img src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/search.svg" alt="search">
									</button>
								</div>
							</form>
						</div>
						<div>
							<ul>
								<li>
									<a class="d-block page_font animated_menu_el" href="/category/أقلًا-منا/">
										أقلًا منا
									</a>
								</li>
								<li>
									<a class="d-block page_font animated_menu_el" href="/category/منشورات/">
										منشورات
									</a>
								</li>
								<li>
									<a class="d-block page_font animated_menu_el" href="/videos/">
										شاهد
									</a>
								</li>
								<li>
									<a class="d-block page_font animated_menu_el" href="/category/نشرة-نقد/">
										نشرة نقد
									</a>
								</li>
							</ul>
							<div class="green-border"></div>
							<ul>
								<li>
									<a class="d-block page_font animated_menu_el" href="/personal-info">
										اكتبوا معنا
									</a>
								</li>
								<li>
									<a class="d-block page_font animated_menu_el" href="/about-and-contact-us">
										عن نقد
									</a>
								</li>
								<li>
									<a class="d-block page_font animated_menu_el" href="/about-and-contact-us#contact-us">
										اتصلوا بنا
									</a>
								</li>
							</ul>
							<ul class="social-media-icons pt-3">
								<li class="mx-1">
									<a href="<?php echo $social_media_links['insta']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-active.svg" alt="insta">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-stroke.svg" alt="insta">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['facebook']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-active.svg" alt="fb">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-stroke.svg" alt="fb">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['linkedin']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-active.svg" alt="linkedin">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-stroke.svg" alt="linkedin">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['rss_feed']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-active.svg" alt="RSS">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-stroke.svg" alt="RSS">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['treads']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-active.svg" alt="threads">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-stroke.svg" alt="threads">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['tiktok']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-active.svg" alt="tiktok">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-stroke.svg" alt="tiktok">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['whatsapp']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-active.svg" alt="whatsapp">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-stroke.svg" alt="whatsapp">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['x']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-active.svg" alt="X">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-stroke.svg" alt="X">
									</a>
								</li>
								<li class="mx-1">
									<a href="<?php echo $social_media_links['youtube']; ?>" class="single-social-icon">
										<img class="active" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-active.svg" alt="youtube">
										<img class="stroke" src="<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-stroke.svg" alt="youtube">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
</div>
<script>
jQuery(document).ready(function($) {
	// toggle theme
	if (localStorage.getItem('theme') === 'light') {
		$('body').addClass('light-theme');
		$('#toggle-change input[type="checkbox"]').attr('checked', false);
		$('#logo').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/naqd-logo-black.svg');
		$('#naqd_footer').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/naqd-logo-black.svg');
		changeIconColor('light');
	}
	// Toggle theme on button click
	$('#toggle-change svg').click(function(event) {
		if (localStorage.getItem('theme') === 'dark') {
			localStorage.setItem('theme', 'light');
			$('body').addClass('light-theme');
			$('#logo').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/naqd-logo-black.svg');
			$('#naqd_footer').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/naqd-logo-black.svg');
			changeIconColor('light');
		} else {
			localStorage.setItem('theme', 'dark');
			$('body').removeClass('light-theme');
			$('#logo').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/Naqd-logo-white.svg');
			$('#naqd_footer').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/images/Naqd-logo-white.svg');
			changeIconColor('dark');
		}
	});
	$('.menu_mobile_nav').click(function(event) {
		$(this).toggleClass('active');
		$('html, body').toggleClass('hide_scroll');
		$('.menu_on_mobile').toggleClass('active');
		$('.transparent-black-overlay').toggleClass('d-none');
	});
	$('#changeTheme').click(function(){
		$('.EN').toggleClass('d-none');
		$('.AR').toggleClass('d-none');
	})
	$(document).on("click", function(event) {
		if (!$(event.target).closest(".menu_on_mobile").length && !$(event.target).closest(".menu_mobile_nav").length ) {
			$('.menu_mobile_nav').removeClass('active');
			$('html, body').removeClass('hide_scroll');
			$('.menu_on_mobile').removeClass('active');
			$('.transparent-black-overlay').addClass('d-none');
		}
	});
	function isInViewport(element) {
		const rect = element.getBoundingClientRect();
		return rect.top <= window.innerHeight && rect.bottom >= 0;
	}
	function checkFadeIn() {
		$('.fade-in').each(function () {
			if (isInViewport(this)) {
				$(this).addClass('visible');
			} else {
				$(this).removeClass('visible');
			}
		});
	}
	$(window).on('resize', checkFadeIn);
	checkFadeIn(); // Run on page load too
	$(window).on('scroll', function () {
		checkFadeIn();
	});
	$('.single-tag').click(function() {
		<?php if(!is_front_page()){?>
			window.location.href = '<?php echo get_home_url(); ?>/?tagId=' + $(this).attr('data-tagId');
		<?php }?>
		$(this).toggleClass('active');
		var activeTags = [];
		$('.single-tag.active').each(function() {
			activeTags.push($(this).attr('data-tagId'));
		});
		if(activeTags.length !== 0){
			filterPostsBasedTags(activeTags);
		} else {
			window.location.href = '<?php echo get_home_url(); ?>';
		}
	})
	function filterPostsBasedTags(activeTags) {
		$.ajax({
			type: 'POST',
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			data: {
				action: 'filter_post_based_tags',
				tags: activeTags,
			},
			success: function(response) {
				if (response === ''){
					// $('#load-more-button-cat').hide();
				}
				if (response) {
					$('#filter-container').replaceWith(response);
				} else {
					// No more posts to load
					// $('#load-more-button-cat').hide();
				}
			},
		});
	}
	// filter page after redirect
	<?php if(isset($_GET['tagId'])){?>
		$('.single-tag[data-tagId="<?php echo $_GET['tagId']; ?>"]').click();
	<?php }?>
	function changeIconColor(theme){
		if(theme === 'light'){
			$('.insta-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-light-active.svg');
			$('.insta-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-light-stroke.svg');
			$('.fb-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-light-active.svg');
			$('.fb-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-light-stroke.svg');
			$('.linkedin-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-light-active.svg');
			$('.linkedin-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-light-stroke.svg');
			$('.rss-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-light-active.svg');
			$('.rss-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-light-stroke.svg');
			$('.tiktok-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-light-active.svg');
			$('.tiktok-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-light-stroke.svg');
			$('.whatsapp-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-light-active.svg');
			$('.whatsapp-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-light-stroke.svg');
			$('.x-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-light-active.svg');
			$('.x-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-light-stroke.svg');
			$('.youtube-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-light-active.svg');
			$('.youtube-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-light-stroke.svg');
			$('.threads-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-light-active.svg');
			$('.threads-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-light-stroke.svg');
			$('.bell').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/bell-light.svg');
			$('.arrow-up').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow-up-light.svg');
			$('.feature').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/feature-light.png');
			$('.submit-img').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow_purple.svg');
			$('#progressBar').css('background-color', '#5D0EE6');
		} else {
			$('.insta-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-active.svg');
			$('.insta-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/insta-dark-stroke.svg');
			$('.fb-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-active.svg');
			$('.fb-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/fb-dark-stroke.svg');
			$('.linkedin-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-active.svg');
			$('.linkedin-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/linkedin-dark-stroke.svg');
			$('.rss-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-active.svg');
			$('.rss-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/rss-dark-stroke.svg');
			$('.tiktok-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-active.svg');
			$('.tiktok-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/tiktok-dark-stroke.svg');
			$('.whatsapp-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-active.svg');
			$('.whatsapp-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/whatsapp-dark-stroke.svg');
			$('.x-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-active.svg');
			$('.x-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/x-dark-stroke.svg');
			$('.youtube-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-active.svg');
			$('.youtube-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/youtube-dark-stroke.svg');
			$('.threads-active').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-active.svg');
			$('.threads-stroke').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/threads-dark-stroke.svg');
			$('.bell').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/bell-dark.svg');
			$('.arrow-up').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow-up-dark.svg');
			$('.feature').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/feature-dark.png');
			$('.submit-img').attr('src', '<?php echo get_template_directory_uri(); ?>/inc/assets/icons/arrow_green.svg');
			$('#progressBar').css('background-color', '#B6E60D');
		}
	}
});
</script>
<div class="site-content">
