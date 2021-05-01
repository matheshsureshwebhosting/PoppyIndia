<?php
$to = 'balaji.hdt@gmail.com';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: balajijoswa@gmail.com' . "\r\n" .
    'Reply-To: balajijoswa@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);
?>