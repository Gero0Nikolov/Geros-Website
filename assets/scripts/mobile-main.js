// Cache Container
var $menuTrigger;
var $menuContainer;

jQuery( document ).ready( function(){
    if ( jQuery( "#main-menu-nav-line" ).length > 0 ) {
        $menuTrigger = jQuery( "#main-menu-nav-trigger" );
        $menuContainer = jQuery( "#main-menu" );

        setMenuActions();
    }
} );

function setMenuActions() {
    $menuTrigger.on( "click", function(){
        jQuery( this ).toggleClass( "menu-in" );
        $menuContainer.toggleClass( "hidden-menu" );
    } );
}