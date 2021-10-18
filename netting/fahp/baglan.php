<?php

try {
    $db = mysqli_connect("localhost", "root", "mardin47", "fahp");
    $db->set_charset("utf8");

} catch (ErrorException  $exception) {
    echo $exception;
}


?>