<?php
session_start();
if (isset($_POST["send"])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $user = get_user_by_email($email);

    if ($user) {
        set_flash_message('message', 'Этот <strong>Email</strong> уже занят другим пользователем, введите другой адрес!');
        redirect_to('task_11.php');
    }
}
add_user($email, $password);

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

//поиск пользователя по  электронному адресу
function get_user_by_email($email)
{
    $db = getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);

    return $user = $stmt->fetch();
}

//добавить пользователя в БД
function add_user($email, $password)
{
    $db = getConnection();
//    $sql = "INSERT INTO users ( `email`, `password`) VALUES ( '$email', '$password')";
//    $db->exec($sql);
//    $id = $db->lastInsertId();

    $sql = "INSERT INTO `users` SET email = :email, password = :password ";

    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    $result->execute();

    set_flash_message('message', 'Регистрация успешна');
    redirect_to('task_11.php');

    return true;
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