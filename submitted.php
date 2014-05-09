<?php
            $email_to = "justinandersun@gmail.com";
            $email_subject = "Message from Jolly Goat";
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['comments'];

            
            $email_message = "Hey Justin, \n\n";
            
            function clean_string($string) {
              $bad = array("content-type","bcc:","to:","cc:","href");
              return str_replace($bad,"",$string);
            }
            
            $email_message .= "name: ".clean_string($name)."\n";
            $email_message .= "email: ".clean_string($email)."\n";
            $email_message .= "message: ".clean_string($message)."\n";

            $headers = 'From: '.$name."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/'.phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);  
        ?>