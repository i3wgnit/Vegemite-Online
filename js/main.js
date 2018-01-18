( function() {
    var throttle = function( type, name, obj ) {
        var obj = obj || window,
            running = false,
            func = function() {
                if ( running ) {
                    return;
                }
                running = true;
                requestAnimationFrame( function() {
                    obj.dispatchEvent( new CustomEvent( name ) );
                    running = false;
                } );
            };
        obj.addEventListener( type, func );
    };
    throttle( "resize", "optimizedResize" );
} )();

function find( selector ) {
    return document.querySelectorAll( selector );
}

function load( url, element ) {
    var xmlRequest = new XMLHttpRequest();
    xmlRequest.onreadystatechange = function() {
        if ( xmlRequest.readyState == 4 ) {
            element.innerHTML = xmlRequest.responseText;
        }
    };
    xmlRequest.open( "GET", url, true );
    xmlRequest.send();
}

function fit( element ) {
    element.style.height = 999;
    element.style.height = Math.max( window.innerHeight -
        document.body.scrollHeight +
        element.scrollHeight - 16, 384 );
}

function navButtonReset() {
    var navButton = find( "#nav div:not(#timer)" ), i = 0;
    for ( ; i < navButton.length; i++ ) {
        navButton[i].className = "navButton";
    }
    return false;
}

function navButtonRefresh() {
    var navButton = find( "#nav .navButton" ), i = 0;
    for ( ; i < navButton.length; i++ ) {
        navButton[i].addEventListener( "click", function() {
            document.content.window.location = this.getAttribute( "data-url" );
            navButtonReset();
            this.className += " current";
        } );
    }
    return false;
}

function shop() {
    var button = document.content.document.getElementsByClassName( "button" ), i = 0;
    for ( ; i < button.length; i++ ) {
        button[i].addEventListener( "click", function() {
            shopBuy( this.getAttribute( "data-name" ),
                    document
                    .content
                    .document
                    .getElementById( this.getAttribute( "data-name" ) + "input" ).value ) ;
            document
            .content
            .document
            .getElementById(this.getAttribute( "data-name" ) + "input" ).removeAttribute( "value" );
        } );
    }
}

function shopBuy( name, value ) {
    if ( value ) {
        document.getElementById( "input" ).setAttribute( "name", name );
        document.getElementById( "input" ).setAttribute( "value", value );
        document.hiddenForm.submit();
    }
}

function logout() {
    location.reload();
}
