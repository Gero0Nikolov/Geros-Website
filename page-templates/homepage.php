<?php
// Template Name: Homepage

get_header();
?>

<div id="homepage-container" class="homepage-container page-container">
    <?php    
    get_view( "main-menu" );
    get_view( "homescreen" );
    ?>
</div>

<?php
get_footer();
?>