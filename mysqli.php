<?php
$mysqli = new mysqli('mysql.grendelhosting.com', 'u849438918_vegeo', '123soleil', 'u849438918_vegeo');
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>