<?php
$firstname = $name = $email = $phone = $message = "";
$firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
$isSuccess = false;
$emailTo = "tchamitchabat@gmail.com";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname =verifyInput($_POST['firstname']);
    $name = verifyInput($_POST['name']);
    $email = verifyInput($_POST['email']);
    $phone =verifyInput($_POST['phone']);
    $message = verifyInput($_POST['message']);
    $isSuccess = true;
    $emailText = "";
if(empty($firstname))
{
    $firstnameError = "je veux connaitre ton prenom";
    $isSuccess = false;
}
else
{
    $emailText .="Prenom: $firstname\n";
}
if(empty($name))
{
    $nameError = "je veux tout savoir mm ton nom";
    $isSuccess = false;
}
else{
    $emailText .="Name: $name\n";
}
if(empty($message))
{
    $messageError = "Qu'est-ce que tu veux me dire ?";
    $isSuccess = false;
}
else{
    $emailText .="Message: $message\n";
}
if(!isEmail($email))
{
    $emailError ="T'essaies de me rouler ? C'est pas un email sa";
    $isSuccess = false;

}
else{
    $emailText .="Email: $email\n";
}

if(!isPhone($phone))
{
    $phoneError= "on veux que des chiffres et des espaces(6999999), stp...";
    $isSuccess = false;
}
else
{
    $emailText .="Phone: $phone\n";
}
if($isSuccess)
{
    // envoi de l email
    $headers = "From: $firstname $name <$email>\r\nReply-To: $email";
    mail($emailTo, "Un message de votre site", $emailText , $headers);
    $firstname = $name = $email = $phone = $message = "";
}

}
function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}

function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
    <title>Contactez-moi !</title>
</head>
<body>
    <div class="container">
        <div class="divider"></div>
        <div class="heading">
            <h2>Contactez-moi</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" role="form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstname">Prenom<span class="blue">*</span></label>
                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="votre prenom" value="<?php echo $firstname; ?>">
                        <p class="comments"><?php echo $firstnameError;?> </p>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Nom<span class="blue">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="votre nom" value="<?php echo $name; ?>">
                        <p class="comments"><?php echo $nameError;?> </p>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email<span class="blue">*</span></label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="votre email" value="<?php echo $email; ?>">
                        <p class="comments"><?php echo $emailError;?></p>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Telephone</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="votre tel:" value="<?php echo $phone; ?>">
                        <p class="comments"><?php echo $phoneError;?> </p>
                    </div>
                    <div class="col-md-12">
                        <label for="message">Message<span class="blue">*</span></label>
                        <textarea id="message" name="message" class="form-control"placeholder="votre message" rows="4"><?php echo $firstname; ?></textarea>
                        <p class="comments"><?php echo $messageError;?></p>
                    </div>
                    <div class="col-md-12">
                     <p class="blue"><strong>* Ces informations sont requises</strong></p>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="button1" value="Envoyez">
                    </div>
                </div>
                <p class="thank-you" style="display:<?php if ($isSuccess) echo 'block'; else echo'none';?>">votre message a bien ete envoye. merci de m'avoir contactez :))</p>
            </form>     
            </div>
        </div>
    </div>
    
</body>
</html>