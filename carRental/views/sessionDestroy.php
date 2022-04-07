<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['permission_level']);
//unset($_SESSION['$connection']);
//unset($_SESSION['
session_destroy();
header('Location: ../index.php');