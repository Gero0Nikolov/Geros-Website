<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gero\'s
 */

get_header();
?>

<div id="page-404-container" class="page-404-container">
	<?php    
    get_view( "main-menu" );
    get_view( "404" );
    ?>
</div>

<?php
get_footer();
