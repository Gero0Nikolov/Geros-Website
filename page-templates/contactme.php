<?php 
// Template Name: Contact Me

get_header();
?>

<div id="contact-me-page-container" class="contact-me-page-container page-container">
    <?php    
    get_view( "main-menu" );
    get_view( "contactme" );
    ?>
</div>

<?php
get_footer();
?>