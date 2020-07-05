<div class="content-container animated fadeIn">
    <?php 
    get_view( "search" );

    // Get Homepage ID
    $homepage_id = get_option( "page_on_front" );

    // Get 404 Content
    $page_404_content = '<h2>Ooh, no! 😮</h2>
    Looks like the page doesn&apos;t exist anymore. 😔
    But don&apos;t worry, here you can find the latest posts written by <a href="https://geronikolov.com" target="_blank" rel="noopener">Gero Nikolov</a> instead!
    Grab them, you won&apos;t be disappointed! 🤩';
    
    // Get Articles
    $args = array(
        "posts_per_page" => 4,
        "post_type" => "post",
        "post_status" => "publish",
        "orderby" => "post_date",
        "order" => "DESC"
    );
    $posts = get_posts( $args );
    ?>

    <div id="page-404-content" class="page-404-content text-content section">
        <?php echo wpautop( $page_404_content, true ); ?>
    </div>
    <div id="posts-container" class="posts-container">
        <?php
        foreach ( $posts as $post ) {
            $object_ = new stdClass;
            $object_->id = $post->ID;
            $object_->title = $post->post_title;
            $object_->content = wp_trim_words( $post->post_content, 55, "..." );
            $object_->thumbnail = get_the_post_thumbnail_url( $post->ID, "full" );
            $object_->date = date( "d M Y", strtotime( $post->post_date ) );
            $object_->url = get_permalink( $post->ID );
            ?>

            <div id="post-<?php echo $object_->id; ?>" class="post-<?php echo $object_->id; ?> article">
                <span class="date padding-side">
                    <a href="<?php echo $object_->url; ?>" class="invisible-anchor">
                        <?php echo $object_->date; ?>
                    </a>
                </span>
                <a href="<?php echo $object_->url; ?>" class="invisible-anchor  padding-side">
                    <img src="<?php echo !empty( $object_->thumbnail ) ? $object_->thumbnail : get_default_thumbnail(); ?>" class="thumbnail" alt="<?php echo $object_->title; ?> thumbnail image." />
                </a>
                <h2 class="title padding-side">
                    <a href="<?php echo $object_->url; ?>" class="invisible-anchor">
                        <?php echo $object_->title; ?>
                    </a>
                </h2>
                <div class="excerpt padding-side">
                    <a href="<?php echo $object_->url; ?>" class="invisible-anchor">
                        <?php echo $object_->content; ?>
                    </a>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
    <?php get_view( "footer" ); ?>
</div>