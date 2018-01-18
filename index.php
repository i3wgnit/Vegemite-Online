<?php
    include "mysqli.php";
    session_start();
    if ($_SESSION['id']) {
        $username = $_SESSION['username'];
        $id = $_SESSION['id'];
        $query = "SELECT * FROM vegemiteOnline WHERE id = '" . $id .
            "' AND username = '" . $username . "'";
        if ($result = $mysqli->query($query)) {
            $row = $result->fetch_assoc();
            $result->close();
            if(!$row['id']) {
                header("Location: login.php");
            }
        } else {
            echo "Connection Error";
            exit;
        }
    } else {
        header("Location: login.php");
    }
?>
<html>
    <head>
        <title>Vegemite Online</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="js/main.js">
        </script>
    </head>
    
    <body>
        <div id="header">
            <div id="header_cont">
                <div id="nav">
                    <img src="css/img/logo.png" width="125" height="120" />
                    <?php
                        $nav = unserialize($row['nav']);
                        for ( $i = 0; $i < count($nav); $i++ ) {
                            echo "<div data-url='" . $nav[$i][0] . "'>" . $nav[$i][1] . '</div>';
                        }
                    ?>
                </div>
                <noscript>You Must Have Javascript Enabled For This Game To Work</noscript>
                <iframe id="info" name="info" scrolling="no" allowtransparency="true"></iframe>
            </div>
        </div>
        <div id="wrap">
            
            <div id="wrap_left">
                <iframe id="content" name="content" allowtransparency="true">
                </iframe>
            </div>
            
            <div id="wrap_right">
                <iframe id="chat" name="chat" allowtransparency="true">
                </iframe>
            </div>
            
        </div>
        
        <form name="hiddenForm" class="hidden" target="info" method="post" action="content/info.php">
            <input id="input" />
        </form>
    </body>
    <script type="text/javascript">
        var currentPage = navButtonReset()
            || navButtonRefresh() || <?php echo isset($_GET['url'])? $_GET['url'] : 0 ?> ,
            currentNav = find( "#nav .navButton" )[currentPage],
            click = new MouseEvent( "click", {
                'view': window,
                'bubbles': true,
                'cancelable': true } ),
            resize = new Event( "optimizedResize" );
        window.addEventListener( "optimizedResize", function() {
            fit( document.getElementById( "wrap" ) );
        } );
        window.dispatchEvent( resize );
        document.chat.window.location = "chat/index.php";
        document.info.window.location = "content/info.php";
        currentNav.dispatchEvent( click );
        var timer = 600;
        setInterval( function() {
            if ( !timer ) {
                shopBuy( "vegemite", -1 );
                shopBuy( "vegemite", -1 );
                timer = 600;
            }
            var sec = timer % 60, min = ( timer - sec ) / 60;
            if ( sec < 10 ) {
                sec = "0" + sec;
            }
            document.getElementById( "timer" ).innerHTML = min + " : " + sec;
            --timer;
        }, 1000 );
    </script>
</html>