<?php 
$front_page_id = get_option( "page_on_front" );

$placeholder = get_field( "search_container_input", $front_page_id );
$logo = get_field( "search_container_logo", $front_page_id );
?>

<div id="search-container" class="search-container animated fadeIn">
    <div id="search-box" class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="<?php echo $placeholder; ?>">
        <div id="results" class="search-results"></div>
    </div>
    <a href="<?php echo get_site_url(); ?>" class="logo-anchor">
        <img src="<?php echo $logo; ?>" alt="GeroNikolov.com logo" />
    </a>
</div>