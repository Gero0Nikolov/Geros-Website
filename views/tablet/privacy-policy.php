<div class="content-container animated fadeIn">
    <?php 
    get_view( "search" );
    global $post;
    ?>
    <div id="privacy-policy-content-container" class="privacy-policy-content-container text-content">
        <?php echo wpautop( $post->post_content, true ); ?>
    </div>
</div>