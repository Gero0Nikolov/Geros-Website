<?php 
// Template Name: Ideas
get_header();
?>

<div id="ideas-page-container" class="ideas-page-container page-container">
    <?php    
    get_view( "main-menu" );
    get_view( "ideas" );
    ?>
</div>

<?php
get_footer();
?>