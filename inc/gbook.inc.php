<?php
/* Основные настройки */
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "gbook");
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
/* Основные настройки */

/* Сохранение записи в БД */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strtolower(trim(strip_tags($_POST["name"])));
    $email = strtolower(trim(strip_tags($_POST["email"])));
    $msg = strtolower(trim(strip_tags($_POST["msg"])));

    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        file_put_contents("log/path.log", mysqli_error(), FILE_APPEND);
    }
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $del = $_GET["del"];
    $sql = "DELETE FROM msgs WHERE id = $del";
    $resdel = mysqli_query($link, $sql);
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */
$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC";
$result = mysqli_query($link, $sql);
mysqli_close($link);
$count = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $count++;
    $date = date("d-m-Y H:i:s", $row["dt"]);
    $url = $_SERVER["REQUEST_URI"] . "&del=" . $row["id"];
    echo "<p>";
    echo "<a href = 'mailto:{$row["email"]}'>{$row["name"]}</a>
         <br/>$date<br/> написал {$row["msg"]}";
    echo "</p>";
    echo "<p align = 'right'>";
    echo "<a href = '$url'>Удалить</a>";
    echo "</p>";
}
echo "<p>Всего записей в гостевой книге: $count</p>";
/* Вывод записей из БД */
?>