<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gero\'s
 */

get_header();
?>

<div id="archive-container" class="archive-container page-container">
    <?php    
	get_view( "main-menu" );
	
	if ( is_post_type_archive( "post" ) ) {
		get_view( "articles" );
	} elseif ( is_post_type_archive( "projects" ) ) {
		get_view( "ideas" );
	}
    ?>
</div>

<?php
get_footer();
