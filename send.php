<?php
$to = 'matheshsureshofficial@gmail.com';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: balajijoswa@gmail.com' . "\r\n" .
    'Reply-To: balajijoswa@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();

echo "Entered";

if(@mail($to, $title, $content, $titles))
{
  echo "Mail Sent Successfully";
}else{
  echo "Mail Not Sent";
}
?>