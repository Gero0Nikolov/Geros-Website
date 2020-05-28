<div class="content-container animated fadeIn">
    <?php 
    get_view( "search" );

    $args = array(
        "posts_per_page" => -1,
        "post_type" => "projects",
        "post_status" => "publish",
        "orderby" => "post_date",
        "order" => "DESC"
    );
    $posts = get_posts( $args );
    ?>

    <div id="projects-posts-container" class="projects-posts-container padding-side">
        <?php
        foreach ( $posts as $post ) {
            $object_ = new stdClass;
            $object_->id = $post->ID;
            $object_->title = $post->post_title;
            $object_->thumbnail = get_the_post_thumbnail_url( $post->ID, "full" );
            $object_->url = get_permalink( $post->ID );
            ?>

            <div id="project-<?php echo $object_->id; ?>" class="project-<?php echo $object_->id; ?> project">
                <a href="<?php echo $object_->url; ?>" class="invisible-anchor">
                    <img src="<?php echo !empty( $object_->thumbnail ) ? $object_->thumbnail : get_default_thumbnail(); ?>" class="thumbnail" alt="<?php echo $object_->title; ?> thumbnail image." />
                </a>
                <h2 class="title">
                    <a href="<?php echo $object_->url; ?>" class="invisible-anchor">
                        <?php echo $object_->title; ?>
                    </a>
                </h2>
            </div>

            <?php
        }
        ?>
    </div>
</div>