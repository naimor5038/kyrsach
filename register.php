<?php
require_once 'config.php';

try {
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);}
catch (PDOException $e) {
    echo '{"Error!": {"text": "' . $e->getMessage().'"}}';
    die();
}


if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['name'])) {
    $login = $_POST['login'];
    $pas = $_POST['password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $sql = sprintf("INSERT INTO `users` (`LOGIN`, `EMAIL`, `PASSWORD`, `NAME`) VALUES ('%s','%s','%s','%s')", $login,$email,$pas,$name);

    $count = $db->exec($sql);
    if ($count === 1) {
        echo '{"response":{"text":"Вы успешно зарегистрировались"}}';
    }
    else {
        echo '{"error": {"text": "Не удалось создать пользователя"}}';
    }
}
else {
    echo '{"error": {"text": "Не передан логин или пароль"}}';
}
?>