<?php
session_start();

//session_destory();

unset($_SESSION['aid']);
unset($_SESSION['aname']);

echo "<script>";
echo "window.location='index2.php';";
echo "</script>";

?>