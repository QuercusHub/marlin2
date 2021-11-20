<?php

if (!empty($_FILES)) {
    $total = count($_FILES['img']['name']);

    for ($i = 0; $i < $total; $i++) {
        if (isset($_FILES['img']['name'][$i])) {
            $target = 'uploads/' . time() .'_'. $_FILES['img']['name'][$i];
            $tmp = $_FILES['img']['tmp_name'][$i];
            move_uploaded_file($tmp, $target);

            $db = getConnection();
            $sql = "INSERT INTO `images` SET image = :image";
            $result = $db->prepare($sql);
            $result->bindParam(':image', $target, PDO::PARAM_STR);
            $result->execute();


        }
    }
    header('Location: task_15_2.php');
    exit();
}


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

function view_images()
{

    $db = getConnection();
    $sql = 'SELECT * FROM images';

    $result = $db->prepare($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    return $result->fetchAll();
}