<?php
session_start();
session_destroy();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    <body onload="top.logout()" style="background: transparent;">
        <div id="frame">
            <div class="v-wrap">
                <div class="content">
                    Logout
                </div>
            </div>
        </div>
    </body>
</html>