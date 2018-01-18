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
    $vegeD = intval($row['vegeD']);
    $vegemite = intval($row['vegemite']);
    $vegeChoco = intval($row['vegeChoco']);
}
if (isset($_POST['vegemite'])) {
    $vegemite += intval($_POST['vegemite']);
    if (intval($_POST['vegemite']) > 0) {
        $vegeD -= intval($_POST['vegemite']) * 1000;
    } else {
        $vegeD -= intval($_POST['vegemite']) * 2499;
    }
}
if (isset($_POST['vegeChoco'])) {
    $vegeChoco += intval($_POST['vegeChoco']);
    if (intval($_POST['vegeChoco']) > 0) {
        $vegeD -= intval($_POST['vegeChoco']) * 500;
    } else {
        $vegeD -= intval($_POST['vegeChoco']) * 999;
    }
}
if ($vegeD >= 0 && $vegeChoco >= 0 && $vegemite >= 0) {
    $query = "UPDATE vegemiteOnline" .
        " SET vegeD = " . $vegeD .
        ", vegemite = " . $vegemite .
        ", vegeChoco = " . $vegeChoco .
        " WHERE id = '" . $id .
        "' AND username = '" . $username . "'";
    $mysqli->query($query);
    $query = "SELECT * FROM vegemiteOnline WHERE id = '" . $id .
        "' AND username = '" . $username . "'";
    if ($result = $mysqli->query($query)) {
        $row = $result->fetch_assoc();
        $result->close();
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    <body style="background: transparent;">
        <div id="info">
            <div id="info_left" style="background-image: url(../css/img/title/<?php echo $row['title'] ?>.png)"></div>

            <div id="info_right">
                <div id="name">
                    <?php echo $username ?>
                </div>
                <div id="vegeD">
                    <?php echo round(intval($row['vegeD'])/100, 2) ?>
                    <div><span></span></div>
                </div>
            </div>
        </div>
    </body>
</html>