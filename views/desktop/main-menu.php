<?php 
$post_id = get_the_ID();
$page_color = get_field( "page_color", $post_id );

$front_page_id = get_option( "page_on_front" );

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
    $item_->target = !empty( $item->target ) ? $item->target : "_top";
    array_push( $menu_items, $item_ );
}
?>

<div id="main-menu" class="main-menu">
    <div class="upper-context">
        <h1 class="site-header"><?php echo !empty( $page_menu_title ) ? $page_menu_title : get_default_title(); ?></h1>
        <div class="items animated fadeIn">
            <?php 
            foreach ( $menu_items as $item ) {
                ?>

                <a href="<?php echo $item->url; ?>" target="<?php echo $item->target; ?>" class="menu-item">
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
</div>