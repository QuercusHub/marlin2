<?php
session_start();

if(!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}


if(isset($_POST['send'])) {
    ++$_SESSION['counter'];
}

header('Location: task_13.php');
