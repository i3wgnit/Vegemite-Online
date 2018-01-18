<?php 

session_start();

if ( isset( $_SESSION['name'] ) && $_POST['text'] ) {
    $emotes = array("4Head",
                    "BabyRage",
                    "BibleThump",
                    "deIlluminati",
                    "FrankerZ",
                    "HeyGuys",
                    "Kappa",
                    "Keepo",
                    "Kreygasm",
                    "PogChamp",
                    "PJSalt",
                    "ResidentSleeper",
                    "SwiftRage");
    $text = stripslashes( htmlspecialchars( $_POST['text'] ) );
    foreach ( $emotes as $value ) {
        $text = str_replace( $value, "<img src='img/emotes/" . $value . ".png' />", $text );
    }
    $handle = fopen( 'chat.html', 'r' );
    $contents = explode( "</div>", fread( $handle, filesize( 'chat.html' ) ) . "<div class='msg'><strong>" . $_SESSION['name'] . "</strong>: " . $text . "<br></div>" );
    fclose( $handle );
    while ( count( $contents ) > 40 ) {
        array_shift( $contents );
    }
    $handle = fopen( 'chat.html', 'w' );
    fwrite( $handle, implode( "</div>", $contents ) ) . "</div>";
    fclose( $handle );
}

?>
