<?php 
$front_page_id = get_option( "page_on_front" );
$footer = str_replace( "[year]", date( "Y" ), get_field( "footer", $front_page_id ) );
?>
<footer id="colophon" class="site-footer lower-context">
    <div class="site-info">
        <?php echo wpautop( $footer, true ); ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->