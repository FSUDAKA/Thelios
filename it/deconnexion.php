<?php
session_start();
session_destroy();
$url = $_SERVER['HTTP_HOST'];
header("Location: index.php");
exit();