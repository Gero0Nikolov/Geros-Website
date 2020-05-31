<div class="content-container">
    <?php 
    get_view( "search" ); 
    
    // Get Articles
    $args = array(
        "posts_per_page" => -1,
        "post_type" => "post",
        "post_status" => "publish",
        "orderby" => "post_date",
        "order" => "DESC"
    );
    $posts = get_posts( $args );
    ?>

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
</div>