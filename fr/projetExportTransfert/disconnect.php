<?php
    session_start();
    unset($_SESSION['CONNECTED']);
    header('Location: login.php');