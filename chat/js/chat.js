var $chatbox = $( "#chatbox" );

function loadChat() {
    $.ajax( {
        url: "chat.html",
        cache: false,
        success: function( html ) {
            var scroll = $chatbox[0].scrollHeight;
            $chatbox
                .html( html )
                .scrollTop( function() {
                var $this = $( this );
                if ( !$this.scrollTop() ) {
                    $this.animate( { scrollTop: $this[0].scrollHeight } );
                }
            } );
        }
    } );
}

function resizeChat() {
    $chatbox
        .height( 999 )
        .height( window.innerHeight -
                $( document ).height() +
                $chatbox.height() );
}

$( document ).ready( function() {
    $( "#exit" ).click( function() {
        if ( confirm( "Are you sure you want to exit the chat?" ) ) {
            window.location = "index.php?logout=1";
        }
    } );
    $( "#message" ).submit( function( event ) {
        event.preventDefault();
        var usermsg = $( "#usermsg" ).val();
        if ( /\S/.test( usermsg ) ) {
            $.post( "postMsg.php", { text: usermsg } );
            $( "#usermsg" ).val( "" );
            $chatbox.animate( { scrollTop: $chatbox[0].scrollHeight } );
        } else {
            $( "#errormsg" )
                .text( "You may not send an empty message!" )
                .show()
                .fadeOut( 1000 );
            $( window ).scrollTop( $( document ).height() );
        }
        $( "#usermsg" ).focus();
    } );
    $( window ).bind( "resize", resizeChat );
    setInterval( loadChat, 3000 );
    var resize = new Event( "resize" );
    $( window ).load( function() {
        window.dispatchEvent( resize );
    } );
} );
