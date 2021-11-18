<?php
session_start();

if (isset($_POST["send"])) {
    $text = $_POST['text'];

    $_SESSION['message'] = $text;
    header('Location: task_12.php');
}