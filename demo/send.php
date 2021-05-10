<?php
$to = 'sendto@outlook.com';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: sendfrom@outlook.com' . "\r\n" .
    'Reply-To: sendfrom@outlook.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);
?>