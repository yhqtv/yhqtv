<?php
if (file_exists('messages.txt')) {
    $messages = file_get_contents('messages.txt');
    $messages = nl2br($messages); // Convert newlines to <br> for HTML display
    echo $messages;
}
?>