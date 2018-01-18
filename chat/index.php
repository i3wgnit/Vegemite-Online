<?php
include "../mysqli.php";
session_start();
$id = $_SESSION['id'];
$username = $_SESSION['username'];
$query = "SELECT * FROM vegemiteOnline WHERE id = '" . $id .
    "' AND username = '" . $username . "'";
if ($result = $mysqli->query($query)) {
    $row = $result->fetch_assoc();
    $result->close();
    
    switch($row['title']) {
        case 0:
            $title = "Pleb";
            break;
        case 1:
            $title = "Human";
            break;
        case 2:
            $title = "Merchant";
            break;
        case 3:
            $title = "Boss";
            break;
        case 4:
            $title = "Vice-pres";
            break;
        case 5:
            $title = "CEO";
            break;
    }
    $_SESSION['name'] = "[" . $title . "] " . $username;
}

?>

<html>
    
    <head>
        <title>Chat - beta</title>
        <link type="text/css" rel="stylesheet" href="css/style.min.css" />
    </head>

    <body>
        
        <div id="wrapper">
    
            <div id="chatbox">
                <?php
                    $handle = fopen( 'chat.html', 'r' );
                    echo fread( $handle, filesize( 'chat.html' ) );
                    fclose( $handle );
                ?>
            </div>
            
            <form id="message" autocomplete="off">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
            </form>
            <span id="errormsg"></span>
    
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/chat.js"></script>
        
    </body>
    
</html>