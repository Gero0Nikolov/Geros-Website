<?php 
// Template Name: Articles

get_header();
?>

<div id="articles-page-container" class="articles-page-container page-container">
    <?php    
    get_view( "main-menu" );
    get_view( "articles" );
    ?>
</div>

<?php
get_footer();
?>