<div class="content-container animated fadeIn">
    <?php get_view( "search" ); ?>
    <main id="primary" class="site-main single-project-container">
        <?php 
        global $post;
        $post_thumbnail = get_the_post_thumbnail_url( $post->ID );
        $post_thumbnail = !empty( $post_thumbnail ) ? $post_thumbnail : get_default_thumbnail();
        $post_date = date( "d M Y", strtotime( $post->post_date ) );
        ?>
        <article id="post-<?php echo $post->ID; ?>">
            <div class="post-thumbnail-container padding-side">
                <img src="<?php echo $post_thumbnail; ?>" class="thumbnail" alt="<?php echo $post->post_title; ?> icon" />
                <div class="info">
                    <h1 class="post-header">
                        <?php echo $post->post_title; ?>
                    </h1>
                    <span class="date">
                        Released on: <?php echo $post_date; ?>
                    </span>
                </div>
            </div>
            <div class="post-content text-content">
                <?php echo wpautop( $post->post_content, true ); ?>
            </div>
        </article>
    </main>
</div>