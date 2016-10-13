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


<?PHP

if (!empty($_POST['email'] ) ){

	$adresat = 'kontakt@mini-mum.com.pl'; 	// pod ten adres zostanie wysłana wiadomosc
	@$email = $_POST['email'];
	@$content = $_POST['content'];
	$header = 	"From: ktos@serwer.pl \nContent-Type:".
			' text/plain;charset="UTF-8"'.
			"\nContent-Transfer-Encoding: 8bit";
	$header = $_POST['email'] .
			' text/plain;charset="UTF-8"'.
			"\nContent-Transfer-Encoding: 8bit";

	if (mail($adresat, 'Kontakt z MINI-MUM', $content, $header)) {
		echo '<p>Dziękujemy za przesłanie wiadomości<br> <a href="index.html">Powrót</a></p>';
	}


}
	else {
		echo '<p>Twoja wiadomość nie została wysłana. Proszę uzupełnić wszystkie pola. <br> <a href="index.html">Powrót</a></p>';
	}


?>
</body>
</html>
