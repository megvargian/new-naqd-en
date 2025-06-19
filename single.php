<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */
get_header();
?>
<div class="container">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
			the_post_navigation();
		endwhile;
	?>
</div>
<?php
get_footer();
