<?php
session_start();
//загрузка изображения
if (!empty($_FILES)) {
    $image = 'uploads/' . time() . $_FILES["img"]["name"];
    move_uploaded_file($_FILES["img"]["tmp_name"], $image);

    $db = getConnection();
    $sql = "INSERT INTO `images` SET image = :image";

    $result = $db->prepare($sql);
    $result->bindParam(':image', $image, PDO::PARAM_STR);
    $result->execute();

    header('Location: task_15_1.php');
    exit();
}
//удаление изображения
if (isset($_GET['id'])){

    $id_image = $_GET['id'];

    $db = getConnection();
    $sql = 'SELECT * FROM images WHERE id = :id';
//ищем изображение по id и возвращаем строку пути изоюбражения в виде массива
    $sth = $db->prepare($sql);
    $sth->bindParam(':id', $id_image, PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch();

    //..удаляем файл с сервера
    unlink($result['image']);

    //..удаляем файл с базы данных
    $sql = "DELETE FROM images WHERE id = :id";
    $sth = $db->prepare($sql);
    $sth->bindParam(':id', $id_image, PDO::PARAM_INT);
    $sth->execute();

    set_flash_message('message', 'Файл успешно удален!');
    redirect_to('task_15_1.php');
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

function view_images(){

    $db = getConnection();
    $sql = 'SELECT * FROM images';

    $result = $db->prepare($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();

    return $result->fetchAll();
}

function set_flash_message($name, $message)
{
    $_SESSION[$name] = $message;

}

function redirect_to($path)
{
    header('Location: ' . $path);
    exit();
}
