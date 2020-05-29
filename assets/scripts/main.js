// Cache Containers
var $searchContainer;
var $searchBox;
var $contactMeBox;
var $contactMeSend;

// Cache Variables
var searchTriggered = false;
var sendTriggered = false;

jQuery( document ).ready( function(){
    setViewPortStyle();
    setSearchBox();
    setContactMeBox();
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

function setContactMeBox() {
    if ( jQuery( "#contactme-container" ).length > 0 ) {
        $contactMeBox = jQuery( "#contactme-container" );
        $contactMeSend = jQuery( "#contactme-container #send" );

        $contactMeSend.on( "click", function() {
            if ( !sendTriggered ) {
                let data = {
                    name: $contactMeBox.find( "#name" ).val().trim(),
                    email: $contactMeBox.find( "#email" ).val().trim(),
                    reason: $contactMeBox.find( "#reason" ).val().trim(),
                    message: $contactMeBox.find( "#message" ).val().trim()
                };
        
                if (
                    data.name.length > 0 &&
                    data.email.length > 0 &&
                    data.reason.length > 0 &&
                    data.message.length > 0
                ) {
                    sendTriggered = true;
                    $contactMeSend.attr( "disabled", "disabled" );

                    jQuery.ajax( {
                        url: ajax_url,
                        type: "POST",
                        data: {
                            action: "make_contact",
                            data: data
                        },
                        success: function( response ) {
                            if ( typeof response !== "undefined" ) {
                                let result = JSON.parse( response );
                                if ( result ) {
                                    alert( "Message was sent succesfully!" );
                                    window.location.reload();
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

function setViewPortStyle() {
    if ( isMobile() ) {
        if ( window.innerHeight > window.innerWidth ) {
            jQuery( "body" ).addClass( "portrait" );
        } else {
            jQuery( "body" ).addClass( "landscape" );
        }

        window.addEventListener( "orientationchange", function() {
            if ( window.innerHeight > window.innerWidth ) {
                jQuery( "body" ).removeClass( "portrait" ).addClass( "landscape" );
            } else {
                jQuery( "body" ).removeClass( "landscape" ).addClass( "portrait" );
            }
        } );

        jQuery( "body" ).removeClass( "hidden" );
    }
}

function isMobile() {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) { return true; }
    else { return false; }
}