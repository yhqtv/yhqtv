<?php
if (isset($_POST['message']) && isset($_POST['username'])) {
    $message = htmlspecialchars($_POST['message']);
    $username = htmlspecialchars($_POST['username']);
    $ip = $_SERVER['REMOTE_ADDR']; // 获取用户的 IP 地址
    $timestamp = date('Y-m-d H:i:s');

    // Check if IP display setting is enabled
    $showIP = file_exists('show_ip.txt') ? (bool)file_get_contents('show_ip.txt') : true;
    if (!$showIP) {
        $entry = "$timestamp - $username: $message\n";
    } else {
        $entry = "$timestamp - $username ($ip): $message\n";
    }

    file_put_contents('messages.txt', $entry, FILE_APPEND);
}
?>