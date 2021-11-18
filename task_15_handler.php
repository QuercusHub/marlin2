<?php

if (isset($_POST["send"]) && empty($_FILES["img"])) {
    $image = 'uploads/' . time() . $_FILES["img"]["name"];
    move_uploaded_file($_FILES["img"]["tmp_name"], $image);

    $db = getConnection();
    $sql = "INSERT INTO `images` SET image = :image";

    $result = $db->prepare($sql);
    $result->bindParam(':image', $image, PDO::PARAM_STR);
    $result->execute();


    header('Location: task_15.php');
    exit();
}

//exit();


function getConnection()
{
    $host = 'localhost';
    $dbname = 'test';
    $charset = 'utf8';
    $user = 'root';
    $password = '';

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $db = new PDO($dsn, $user, $password, $opt);
    return $db;
}

function view_images(){

    $db = getConnection();
    $sql = 'SELECT * FROM images';

    $result = $db->prepare($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    return $result->fetchAll();
}