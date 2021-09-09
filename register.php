<?php
	
	session_start();
	
	if(isset($_POST['e_mail']))
	{
		$all_OK = true;
		
		$imie = $_POST['imie'];
		
		if((strlen($imie)<3) || (strlen($imie)>20))
		{
			$all_OK= false;
			$_SESSION['e_imie'] = "Imie musi posiadać od 3 do 20 znaków!";
		}
		
		$e_mail = $_POST['e_mail'];
		$e_mail2 = filter_var($e_mail, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($e_mail2, FILTER_VALIDATE_EMAIL)==false) || ($e_mail2!=$e_mail))
		{
			$all_OK = false;
			$_SESSION['e_email'] = "Podaj poprawny adres e-mail";
		}
			
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		if((strlen($pass1)<8) || (strlen($pass1)>20))
		{
			$all_OK = false;
			$_SESSION['e_pass'] = "Hasło musi posiadać od 8 do 20 znaków";
		}
		
		if($pass1 != $pass2)
		{
			$all_OK = false;
			$_SESSION['e_pass'] = "Podane hasła różnią się";
		}	
		
		$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
		
		$secret = "6LfwOkEcAAAAAObZSZIxo0J1xOj9FHQO_yOezTa1";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if($odpowiedz->success == false)
		{
			$all_OK = false;
			$_SESSION['e_bot'] = "Potwierdź, że nie jesteś robotem";
		}
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
			if($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$e_mail'");
				if( !$rezultat) throw new Exception($polaczenie->error);
					
				$ile_takich_maili = $rezultat -> num_rows;
				
				if ($ile_takich_maili > 0)
				{
					$all_OK = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu email!";					
				}
				if($all_OK==true)
				{
					if ($polaczenie->query("INSERT INTO users VALUES(NULL,'$imie','$pass_hash','$e_mail')")) 
					{
						$dane = $polaczenie->query("SELECT * FROM users WHERE email = '$e_mail'");
						$wiersz = $dane->fetch_assoc();
						$userId = $wiersz['id'];
						
						if(($polaczenie->query("INSERT INTO expenses_category_assigned_to_users SELECT 'NULL','$userId',name FROM expenses_category_default")) 
						 &&($polaczenie->query("INSERT INTO payment_methods_assigned_to_users SELECT 'NULL','$userId',name FROM payment_methods_default"))
						&&($polaczenie->query("INSERT INTO incomes_category_assigned_to_users SELECT 'NULL','$userId',name FROM incomes_category_default")))
						{
							$_SESSION['udanarejestracja']="Dziękujemy za rejestrację, możesz się już zalogować!";
							header('Location:index.php');
						}
						else
					{
						throw new Exception($polaczenie->error);
					}
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
				
				$polaczenie->close();
			}
		}
		
		catch(Exception $e)
		{
			echo'Błąd serwera! Przepraszamy za niedogodności.';
			echo'<br/>Informacja developerska:'.$e;
		}
		
	}

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<title>Budżet-domowy</title>
	
	<meta name="description" content="Chcesz lepiej zarządzać swoimi oszczędnościami? Skorzystaj z mojej strony i w łatwy sposób kontroluj swoje wydatki" />
	<meta name="keywords" content="budżet, bilans, pieniądze, oszczędności, oszczędzać" />
	
	<link rel ="stylesheet" href = "style.css" type="text/css" />
	<link rel ="stylesheet" href = "bootstrap/bootstrap.min.css" type="text/css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
	<script src ="script.js"></script>
	<link rel="stylesheet" href="css/fontello.css">

	<script src="https://www.google.com/recaptcha/api.js"></script>
	
	<style>
	.error
	{
	color:red;
	margin-bottom: 5px;
	}
	</style>
	
</head>
<body>

	<header class="text-light">
		 <h1 class="text-center display-1 text-uppercase text-weight-bold" >Budżet domowy </h1>
		<p class="h2 text-center mb-5"> Przejmij kontrolę nad domowymi finansami i ciesz się zaoszczędzonymi pieniędzmi</p>
	</header>
	
	<main>
	<div class="container align-middle text-light">		
			<form method="post" class="bg-success p-4 w-50 mx-auto " style="--bs-bg-opacity: .5;">
				<h2 class="h3 text-center mb-3"> Rejestracja </h2>
				<div class="col-sm-8 col-lg-6 mb-3  mx-auto">
					<label for="Imie" class="form-label"> Imię: </label>
					<input type ="text" class="form-control" id="Imie" name="imie" >		
				</div>
				<?php
					if(isset($_SESSION['e_imie']))
					{
						echo '<div class="error text-center">'.$_SESSION['e_imie'].'</div>';
						unset($_SESSION['e_imie']);
					}				
				?>
				<div class="col-sm-8 col-lg-6 mb-3 w-md-50 mx-auto" >
					<label for="Email" class="form-label"> Email: </label>
					<input type ="text" class="form-control" id="Email" name="e_mail">
				</div>
				<?php
					if(isset($_SESSION['e_email']))
					{
						echo '<div class="error text-center">'.$_SESSION['e_email'].'</div>';
						unset($_SESSION['e_email']);
					}				
				?>
				
				<div class="col-sm-8 col-lg-6 mb-3 w-md-50 mx-auto" >
					<label for="Password" class="form-label"> Hasło: </label>
					<input type ="password" class="form-control" id="Password" name="pass1">
				</div>
				
				<div class="col-sm-8 col-lg-6 mb-3 w-md-50 mx-auto" >
					<label for="Password" class="form-label"> Powtórz hasło: </label>
					<input type ="password" class="form-control" id="Password" name="pass2">					
				</div>
				<?php
					if(isset($_SESSION['e_pass']))
					{
						echo '<div class="error text-center">'.$_SESSION['e_pass'].'</div>';
						unset($_SESSION['e_pass']);
					}				
				?>
				<div class="col-sm-8 col-lg-6 mb-3 w-md-50 mx-auto" >
					<div class="g-recaptcha mt-3" data-sitekey="6LfwOkEcAAAAAAIF0h9mMAJb_Hj3SNt5DNJliU-0"></div>
				</div>
				<?php
					if(isset($_SESSION['e_bot']))
					{
						echo '<div class="error text-center">'.$_SESSION['e_bot'].'</div>';
						unset($_SESSION['e_bot']);
					}				
				?>
				<div class="text-center">
					<input type="submit" class="btn btn-success mx-auto " value="Utwórz konto"/>
					<a href="index.php"><div class="btn btn-secondary mx-1"> Powrót do logowania</div></a>
				</div>
			</form>
			
				
	</div>
		
			
		
	</main>
	
	<footer>
		
		<div class="text-center mt-5 text-light">
			Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
		</div>
		
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script  src ="bootstrap/bootstrap.min.js"></script>
</body>