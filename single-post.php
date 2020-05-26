<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Gero\'s
 */

get_header();
?>
	
<div id="post-container" class="post-container">
	<?php 
	get_view( "main-menu" ); 
	get_view( "post" );
	?>
</div>

<?php
get_footer();
