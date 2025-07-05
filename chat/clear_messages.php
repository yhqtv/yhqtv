<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = 'messages.txt';
    file_put_contents($file, ''); // 清空文件内容
}
?>