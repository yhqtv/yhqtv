<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['showIP'])) {
    $showIP = $_POST['showIP'] === 'true' ? 'true' : 'false';
    file_put_contents('show_ip.txt', $showIP);
}
?>