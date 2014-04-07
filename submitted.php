<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jolly Goat | Submitted</title>
    <link rel="stylesheet" href="css/submitted.css" type="text/css" media="screen">
<body>
    <?php
    if(isset($_POST['email'])){
        $email_to = "justinandersun@gmail.com";
        $email_subject = "Message from JollyGoat.com";
        
        function died($error) {
            echo $error;
            echo "<a href=\"javascript:history.back()\">return</a>";
            die();
        }

        if(!isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['comments'])) {
            died("An error has occurred.");       
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $comments = $_POST['comments'];
        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        $string_exp = "/^[A-Za-z .'-]+$/";

        if(strlen($comments) < 2) {
              $error_message .= "<p>You 
              have more to say than that, right?</p>";
        } else if ((!preg_match($string_exp,$name)) && 
        (!preg_match($email_exp,$email))){
            $error_message .= "<p>Please provide your 
            name and email address.</p>";
        } else {
            if(!preg_match($string_exp,$name)) {
              $error_message .= "<p>Please provide an 
              actual name.</p>";
            }
            if(!preg_match($email_exp,$email)) {
              $error_message .= "<p>Please provide a 
              valid email.</p>";
            }
        }
        if(strlen($error_message) > 0) {
          died($error_message);
        }
        
        $email_message = "Hey Justin, \n\n";
        
        function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
        }
        
        $email_message .= clean_string($comments)."\n\nSincerely,\n";
        $email_message .= clean_string($name)."\n";
        $email_message .= clean_string($email);

        $headers = 'From: '.$name."\r\n".
        'Reply-To: '.$email."\r\n" .
        'X-Mailer: PHP/'.phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);  
    ?><p class="erred">Submitted.</p><a href="index.html">return</a>
    <?php
    } die();
    ?>
</body>
</html>