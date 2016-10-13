<!DOCTYPE html>
<html lang="pl-PL">
<head>
	<title>MINI-MUM kontakt</title>
	<meta charset="UTF-8">
	<meta http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/style_php.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/icon.png">
	<link href='https://fonts.googleapis.com/css?family=Poiret+One|Stalemate&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width initial-scale=1.0">


</head>

<body>

 <?php

if(!empty($_POST['email'])) {



    // EDIT THE 2 LINES BELOW AS REQUIRED

    $email_to = "aneta.szarow@gmail.com";

    $email_subject = "Kontakt z Mini-Mum";





    function died($error) {

        // your error code can go here

        echo "Przykro nam, ale wystąpił problem z wysłaniem Twojej wiadomości. ";

        echo "Znaleźliśmy nas†ępujące błędy:<br /><br />";

        echo $error."<br /><br />";

        echo "Proszę uzupełnić formularz jeszcze raz.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['email']) ||
 	   !isset($_POST['content'])) {

        died('Proszę uzupełnij wszystkie pola.');

    }



    $email_from = $_POST['email']; // required


    $content = $_POST['content']; // required



    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'Nieprawidłowy adres e-mail.<br />';

  }

  if(strlen($content) < 2) {

    $error_message .= 'The Comments you entered do not appear to be valid.<br />';

  }



    $email_message = "Form details below.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }


    $email_message .= "Email: ".clean_string($email_from)."\n";


    $email_message .= "Wiadomość: ".clean_string($content)."\n";





// create email headers

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

?>


<p>Dziękujemy za przesłanie wiadomości<br> <a href="index.html">Powrót</a></p>



<?php

} else {

	echo '<p>Twoja wiadomość nie została wysłana. Wypełnij wszystkie pola. <br> <a href="index.html">Powrót</a></p>';

}

?>

</body>
</html>
