<?php
if (is_file("log/" . PATH_LOG)) {
    $log = file("log/" . PATH_LOG);
}
foreach ($log as $value) {
    list($time, $path, $ref) = explode("|", $value);
    $goodTime = date('d-m-Y H:i:s', $time);
    echo "<p>$goodTime Куда: $path Oткуда: $ref</p>";
}