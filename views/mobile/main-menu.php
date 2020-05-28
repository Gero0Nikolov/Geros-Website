<?php 
$post_id = get_the_ID();
$page_color = get_field( "page_color", $post_id );

$front_page_id = get_option( "page_on_front" );
$footer = str_replace( "[year]", date( "Y" ), get_field( "footer", $front_page_id ) );

$page_menu_title = get_field( "page_menu_title", $post_id );
$main_menu_items = wp_get_nav_menu_items( 2 );

// Build Clean Menu
$menu_items = array();

foreach ( $main_menu_items as $item ) {
    $item_ = new stdClass;
    $item_->id = $item->object_id;
    $item_->url = $item->url;
    $item_->title = $item->title;
    $item_->color = get_field( "page_color", $item_->id );
    $item_->icon  = get_field( "page_icon", $item_->id );
    array_push( $menu_items, $item_ );
}
?>

<div id="main-menu-nav-line" class="main-menu-nav-line">
    <button id="main-menu-nav-trigger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>
    <h1 class="site-header"><?php echo !empty( $page_menu_title ) ? $page_menu_title : get_default_title(); ?></h1>
</div>
<div id="main-menu" class="main-menu hidden-menu">
    <div class="upper-context">
        <div class="items animated fadeIn">
            <?php 
            foreach ( $menu_items as $item ) {
                ?>

                <a href="<?php echo $item->url; ?>" class="menu-item">
                    <span class="color" style="background-color: <?php echo $item->color; ?>;">
                        <i class="<?php echo $item->icon; ?>"></i>
                    </span>
                    <span class="label"><?php echo $item->title ?></span>
                </a>

                <?php
            }
            ?>
        </div>
    </div>
    <footer id="colophon" class="site-footer lower-context">
		<div class="site-info">
            <?php echo wpautop( $footer, true ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div>