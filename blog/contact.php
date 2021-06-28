<?php
  
if($_POST) {
    $Name = "";
    $ReplyTo = "";
    $Subject = "";
    $Body = "";
    $email_body = "<div>";
      
    if(isset($_POST['Name'])) {
        $Name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Name:</b></label>&nbsp;<span>".$Name."</span>
                        </div>";
    }
 
    if(isset($_POST['ReplyTo'])) {
        $ReplyTo = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['ReplyTo']);
        $ReplyTo = filter_var($ReplyTo, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$ReplyTo."</span>
                        </div>";
    }
      
    if(isset($_POST['Subject'])) {
        $Subject = filter_var($_POST['Subject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$Subject."</span>
                        </div>";
    }
      
      
    if(isset($_POST['Body'])) {
        $Body = htmlspecialchars($_POST['Body']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$Body."</div>
                        </div>";
    }
    
      
    $email_body .= "</div>";
    $recipient = "rahilshah042@gmail.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $ReplyTo . "\r\n";
      
    if(mail($recipient, $Subject, $email_body, $headers)) {
        echo "<p>Thanks for contacting me, $Name. If its a question, I'll get back to when I get a chance (if you left an email to reply to).</p>";
    } else {
        echo '<p>Something went wrong</p>';
    }
      
} else {
    echo '<p>Something went wrong</p>';
}
?>