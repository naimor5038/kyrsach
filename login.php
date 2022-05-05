<?php
require_once 'config.php';

try {
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);}
catch (PDOException $e) {
    echo '{"Error!": {"text": "' . $e->getMessage().'"}}';
    die();
}


if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $pas = $_POST['password'];
    $sql = sprintf("SELECT * FROM `users` WHERE `LOGIN` LIKE '%s' AND `PASSWORD` LIKE '%s'", $login,$pas);

	$user = $db->query($sql)->fetch();
	if (!empty($user))  {
		$result = '{"response": [';
		$id = $user['ID'];
		$login = $user ['LOGIN'];
		
		$token = md5(time());
		
		$expiration = time() + 24*60*60;
		$result .= sprintf('{"id":%d,"login":"%s","token":"%s","expiration":%d}',$id,$login,$token,$expiration);
		
		$sql_upd = sprintf("UPDATE `users` SET `TOKEN` = '%s', `EXPIRATION`=FROM_UNIXTIME(%d) WHERE `ID`=%d",$token,$expiration,$id);
		$db->exec($sql_upd);

		$result = rtrim($result, ",");
		$result .= ']}';
		echo $result;	
	}
    else {
        echo '{"error": {"text": "Не удалось найти пользователя"}}';
   }
}
else {
    echo '{"error": {"text": "Не передан логин или пароль"}}';
}
?>