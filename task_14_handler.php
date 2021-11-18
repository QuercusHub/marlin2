<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$user = get_user_by_email($email);

if (!$user) {
    set_flash_message('message', 'Пользователь не найден');
    redirect_to('task_14.php');
}

login($email, $password);


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

//авторизировать пользователя
function login($email, $password)
{
    $user = get_user_by_email($email);

    if (password_verify($password, $user["password"])) {
        $_SESSION["auth"] = true;
        $_SESSION["user"] = [
            "id" => $user["id"],
            "email" => $user["email"]
        ];
        set_flash_message('message', 'Вы успешно авторизованы');
        redirect_to('task_14.php');
    } else {
        set_flash_message('message', 'Не верные данные для входа');
        redirect_to('task_14.php');
    }
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