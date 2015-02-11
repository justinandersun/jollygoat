<?php
$email_to = "justinandersun@gmail.com";
$email_subject = "Holler from Jolly Goat";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['comments'];


$email_message = "Hey Justin, \n\n";

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_message .= clean_string($message)."\n";
$email_message .= "\n"."Sincerely,"."\n".clean_string($name)."\n";
$email_message .= clean_string($email)."\n";

$headers = 'From: '.$name."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/'.phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>