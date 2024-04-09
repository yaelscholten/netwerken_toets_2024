<?php
// Functions to filter user inputs
function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    } else{
        return FALSE;
    }
}
 
// Define variables and initialize with empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $subject = $message = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate user name
    if(empty($_POST["name"])){
        $nameErr = "Vul svp je naam in";
    } else{
        $name = filterName($_POST["name"]);
        if($name == FALSE){
            $nameErr = "Vul svp je naam in";
        }
    }
    
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = "Vul svp een geldig e-mail adres in";     
    } else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = "Vul svp een geldig e-mail adres in";
        }
    }
    
    // Validate message subject
    if(empty($_POST["subject"])){
        $subject = "";
    } else{
        $subject = filterString($_POST["subject"]);
    }
    
    // Validate user comment
    if(empty($_POST["message"])){
        $messageErr = "Vul svp een bericht of vraag in";     
    } else{
        $message = filterString($_POST["message"]);
        if($message == FALSE){
            $messageErr = "Vul svp een bericht of vraag in";
        }
    }
    
    // Check input errors before sending email
    if(empty($nameErr) && empty($emailErr) && empty($messageErr)){
        // Recipient email address
        // this should be <username>@username.gc-webhosting.nl
        $to = 'someone@address.gc-webhosting.nl';
        
        // Create email headers
        $headers = 'From: '. $email . "\r\n" .
        'Reply-To: '. $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        // Sending email
        if(mail($to, $subject, $message, $headers)){
            echo '<p class="success">Je bericht is succesvol verzonden!</p>';
        } else{
            echo '<p class="error">Niet gelukt om te verzenden. Probeer svp opnieuw!</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Formulier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto; }
        .error{ color: red; }
        .success{ color: green; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Contactformulier</h2>
        <p>Vul dit formulier in met jouw vraag</p>
        <form action="helpdesk.php" method="post">
            <div class="form-group">
                <label for="inputName">Naam<sup>*</sup></label>
                <input type="text" name="name" id="inputName" class="form-control" value="<?php echo $name; ?>">
                <span class="error"><?php echo $nameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email adres<sup>*</sup></label>
                <input type="text" name="email" id="inputEmail" class="form-control" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputSubject">Onderwerp</label>
                <input type="text" name="subject" id="inputSubject" class="form-control" value="<?php echo $subject; ?>">
            </div>
            <div class="form-group">
                <label for="inputComment">Bericht/vraag<sup>*</sup></label>
                <textarea name="message" id="inputComment" class="form-control" rows="5" cols="30"><?php echo $message; ?></textarea>
                <span class="error"><?php echo $messageErr; ?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Verstuur">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            <input type="button" class="btn btn-secondary ml-2" value="Terug" onclick="location.href='../index.php';">
        </form>
    </div>
</body>
</html>