<?php

session_start();

	if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
	{
		header('Location: menu.php');
		exit();
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

		
</head>
<body>
	
	<header class="text-light">
		 <h1 class="text-center display-1 text-uppercase text-weight-bold" >Budżet domowy </h1>
		<p class="h2 text-center"> Przejmij kontrolę nad domowymi finansami i ciesz się zaoszczędzonymi pieniędzmi</p>
	</header>
	
	<article>
	<div class="container mt-5 text-light">
			<form class="bg-success p-4 w-50 mx-auto " style="--bs-bg-opacity: .5;" action="login.php" method="post">
				<h2 class="h3 text-center mb-3"> Logowanie </h2>
				<?php
					if(isset ($_SESSION['udanarejestracja'])) echo '<div class="text-center">'.$_SESSION['udanarejestracja'].'</div>';
					unset($_SESSION['udanarejestracja']);
				?>
				<div class="col-sm-8 col-lg-6 mb-3 mx-auto">
					<label for="Email" class="form-label"> Adres Email: </label>
					<input type ="email" class="form-control" id="Email" name="email"/>		
				</div>
				
				<div class="col-sm-8 col-lg-6 mb-3 w-md-50 mx-auto" >
					<label for="Password" class="form-label"> Hasło: </label>
					<input type ="password" class="form-control" id="Password" name="password"/>
				<?php
					if(isset ($_SESSION['blad'])) echo $_SESSION['blad'];
				?>
				</div>
				
				<div class="text-center">
				
					<input type="submit" class="btn btn-success"  value="Zaloguj"/>
					<div class ="mt-3" id="napis"> Nie masz konta? </div>
					<a href="register.php"><div class="btn btn-secondary"> Zarejestruj się</div></a>
				</div>
			</form>
		</div>
	</article>
	
	<footer>
		
		<div class="text-center mt-5 text-light">
			Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
		</div>
		
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script  src ="bootstrap/bootstrap.min.js"></script>
</body>