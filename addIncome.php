<?php
	
	session_start();
	
	if(!isset($SESSION['zalogowany']))
	{
		header('Location:index.php');
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

	<header>	
	 
		<nav class="navbar navbar-dark bg-success navbar-expand-lg">
			
			<a class="navbar-brand" href="#"><img src="img/graph-up.svg" width="30" height="30" class="d-inline-block mx-2 align-bottom text-light" alt=""> Oszczedzaj.pl</a>
			<i class="bi bi-graph-up" aria-hidden="true"></i>
			
			<button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse mx-3" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
					<li class="nav-item ">
						<a class="nav-link" href="menu.php"> Strona główna </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link active" href="addIncome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item ">
						<a class="nav-link" href="addExpense.php"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Przeglądaj bilans
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="showBalance.php">Bieżący miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.php">Poprzedni miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.php">Bieżący rok</a></li>					
						<li><button type="button" class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#Modal">Niestandardowy</button></li>
					  </ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"> Ustawienia </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php"> Wyloguj się </a>
					</li>
				</ul>
			</div>
		</nav>
		
			<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Wprowadź okres bilansu</h5>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
							<div class="modal-body">
								<div class="form-inline mx-auto">
									<label> Data od: <input class="form-control" type="date" name ="dzien"></label>
									<label> Data do: <input class="form-control" type="date" name ="dzien"></label>
								</div>
							</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
								<button type="button" class="btn btn-success">Pokaż bilans</button>
						</div>
					</div>
				</div>
			</div>
	</header>
	
	<article>
	
		<div class="container mt-5 text-light">
		
		 <form class="bg-success p-4 w-50 mx-auto " style="--bs-bg-opacity: .5;">
		
		 <h2 class="text-uppercase text-center mx-auto mb-4">Dodaj przychód</h2>

				<div class="form-inline col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase" for="kwota"> Kwota: </label>
					<input class="form-control" type="text" name="kwota" id="kwota">
				
				</div>
				
				<div class="form-inline col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase" for="data"> Data: </label>
					<input class="form-control" type="date" name="data" id="data">
				</div>
				
				<div class="mt-3 col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase mb-1" > Kategoria: </label>
						<div class="form-check col-sm-8 col-lg-6 mb-3 " >
							<input class="form-check-input " type="radio" name="radios" id="opt1" value="option1" checked>
							 <label class="form-check-label" for="opt1">Wynagrodzenie</label>
						</div>
							
						<div class="form-check col-sm-8 col-lg-6 mb-3 ">
							 <input class="form-check-input" type="radio" name="radios" id="opt2" value="option2">
							 <label class="form-check-label" for="opt2">Odsetki bankowe</label>	
						</div>
							
						<div class="form-check col-sm-8 col-lg-12 mb-3 ">
							<input class="form-check-input" type="radio" name="radios" id="opt3" value="option3">
							<label class="form-check-label" for="opt3">Sprzedaż na allegro</label>
						</div>
						
						<div class="form-check col-sm-8 col-lg-6 mb-3 ">
							<input class="form-check-input" type="radio" name="radios" id="opt4" value="option3">
							<label class="form-check-label" for="opt4">Inne</label>
						</div>
				</div>
				
					 <div class="form-group mt-3 col-sm-8 col-lg-6 mx-auto">
						<label class="text-uppercase" for="komentarz">Komentarz:</label>
						<textarea class="form-control" id="komentarz" rows="3"></textarea>
					  </div>
			
				<div class="mt-3 mx-auto text-center">
					<button type="button" class="btn btn-success">Dodaj</button>
					<button type="button" class="btn btn-warning">Anuluj</button>
				</div>
			</form>	

	
		</div>
	</article>
	
	<footer>
		
		<div class="text-center mt-5">
			Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
		</div>
		
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script  src ="bootstrap/bootstrap.min.js"></script>
</body>