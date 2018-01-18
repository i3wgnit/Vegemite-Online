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
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    
    <body style="background: transparent;">
        <div id="frame">
            <div class="v-wrap">
                <div class="content">
                    <div style="text-align: left; font-size: 1.1em; font-family: arial,sans-serif;">
                        VegeDollars: <?php echo round(intval($row['vegeD'])/100, 2) ?><br/>
                        Vegemite: <?php echo $row['vegemite'] ?><br/>
                        VegeChoco: <?php echo $row['vegeChoco'] ?><br/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>