// Cache Containers
var $searchContainer;
var $searchBox;

// Cache Variables
var searchTriggered = false;

jQuery( document ).ready( function(){
    setSearchBox();
} );

function setSearchBox() {
    if ( jQuery( "#search-container" ).length > 0 ) {
        $searchContainer = jQuery( "#search-box" );
        $searchBox = jQuery( "#search-box input" );

        // Trigger Search
        $searchBox.on( "keyup", function( e ){
            // Clear Previous Listing
            $searchContainer.find( "#results" ).empty();

            if ( 
                e.keyCode == 13 &&
                !searchTriggered
            ) {
                // Prepare for the new search
                let query = jQuery( this ).val().trim();

                if ( query.length > 0 ) {
                    // Lock the search
                    searchTriggered = true;
                    jQuery( this ).attr( "disabled", "disabled" );

                    // Perfom search for Posts, Pages & Projects
                    jQuery.ajax( {
                        url: ajax_url,
                        type: "POST",
                        data: {
                            action: "search_for",
                            query: query
                        },
                        success: function( response ) {
                            // Unlock Search
                            searchTriggered = false;
                            $searchBox.removeAttr( "disabled" );
                            
                            if ( typeof response !== "undefined" ) {
                                let result = JSON.parse( response );

                                if ( result != false ) {
                                    for ( key in result ) {
                                        let object_ = result[ key ];
                                        
                                        let view = "\
                                        <a href='"+ object_.url +"' class='search-result'>\
                                            <span class='title'>"+ object_.title +"</span>\
                                            <i class='color "+ object_.icon +"' style='background-color: "+ object_.color +";'></i>\
                                        </a>\
                                        ";

                                        $searchContainer.find( "#results" ).append( view );
                                    }
                                }
                            }
                        },
                        error: function( response ) {
                            console.log( response );
                        }
                    } );
                }
            }
        } );
    }
}