<?php 
$page_id = get_the_ID();

// Intro
$avatar = get_field( "avatar", $page_id );
$name = get_field( "name", $page_id );
$quote = get_field( "quote", $page_id );
$banner_image = get_field( "banner_image", $page_id );

// Meet Gero
$meet_gero = get_field( "meet_gero", $page_id );

// Latest Articles
$articles = new stdClass;
$articles->title = get_field( "articles_title", $page_id );
$articles->posts = get_field( "articles_relation", $page_id );

// Latest Projects
$projects = new stdClass;
$projects->title = get_field( "projects_title", $page_id );
$projects->posts = get_field( "projects_relation", $page_id );

// Links
$links = new stdClass;
$links->title = get_field( "links_title", $page_id );
$links->links = get_field( "website_links", $page_id );
?>

<div class="content-container">
    <?php get_view( "search" ); ?>
    <div id="intro-container" class="intro-container" style="background-image: url(<?php echo $banner_image; ?>);">
        <div class="overlay">
            <img src="<?php echo $avatar ?>" alt="<?php echo $name ." - ". $quote ." profile image"; ?>" class="avatar" />
            <h2 class="name"><?php echo $name; ?></h2>
            <h3 class="quote"><?php echo $quote; ?></h3>
        </div>
    </div>
    <div id="meet-gero" class="meet-gero text-content section">
        <?php echo wpautop( $meet_gero, true ); ?>
    </div>
    <div id="latest-articles" class="latest-articles section">
        <h2 class="section-title padding-side"><?php echo $articles->title; ?></h2>
        <div class="articles-container">
            <?php 
            foreach ( $articles->posts as $article_id ) {
                $article = new stdClass;
                $article->id = $article_id;
                $article->title = get_the_title( $article_id );
                $article->thumbnail = get_the_post_thumbnail_url( $article_id, "full" );
                $article->url = get_permalink( $article_id );
                ?>

                <a href="<?php echo $article->url; ?>" class="invisible-anchor">
                    <img src="<?php echo !empty( $article->thumbnail ) ? $article->thumbnail : get_default_thumbnail(); ?>" alt="Article <?php echo $article->title; ?> banner image" class="article-banner" />
                    <h3 class="article-title"><?php echo $article->title; ?></h3>
                </a>

                <?php
            }
            ?>
        </div>
    </div>
    <div id="latest-projects" class="latest-projects section">
        <h2 class="section-title padding-side"><?php echo $projects->title; ?></h2>
        <div class="projects-container">
            <?php 
            foreach ( $projects->posts as $project_id ) {
                $project = new stdClass;
                $project->id = $project_id;
                $project->title = get_the_title( $project_id );
                $project->thumbnail = get_the_post_thumbnail_url( $project_id, "full" );
                $project->url = get_permalink( $project_id );
                ?>

                <a href="<?php echo $project->url; ?>" class="invisible-anchor">
                    <img src="<?php echo !empty( $project->thumbnail ) ? $project->thumbnail : get_default_thumbnail(); ?>" alt="Project <?php echo $project->title; ?> logo image" class="project-banner" />
                    <h3 class="project-title"><?php echo $project->title; ?></h3>
                </a>

                <?php
            }
            ?>
        </div>
    </div>
    <div id="links" class="links section padding-side">
        <h2 class="section-title"><?php echo $links->title; ?></h2>
        <div class="links-container">
            <?php 
            foreach ( $links->links as $link ) {
                $link = (object) $link;
                ?>

                <a href="<?php echo $link->url; ?>" target="_blank" class="invisible-anchor">
                    <img src="<?php echo !empty( $link->icon ) ? $link->icon : get_default_thumbnail(); ?>" alt="Link <?php echo $link->label; ?> icon" class="link-icon" />
                    <h3 class="link-title"><?php echo $link->label; ?></h3>
                </a>

                <?php
            }
            ?>
        </div>
    </div>
    <?php get_view( "footer" ); ?>
</div>