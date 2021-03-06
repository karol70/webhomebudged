<?php
	
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
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
			<button class="navbar-toggler mx-3" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
					<li class="nav-item ">
						<a class="nav-link active" href="menu.php"> Strona główna </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addIncome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addExpense.php"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Przeglądaj bilans
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="showBalance.php?biezacymiesiac=true" >Bieżący miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.php?poprzednimiesiac=true" >Poprzedni miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.php?biezacyrok">Bieżący rok</a></li>					
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
						<form method="post" action="showBalance.php">
								<div class="modal-body">
									<div class="form-inline mx-auto">
										<label> Data od: <input class="form-control" type="date" name ="dataod"></label>
										<label> Data do: <input class="form-control" type="date" name ="datado"></label>
									</div>
								</div>
							<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
									<input type="submit" class="btn btn-success" value="Pokaż bilans"/>
							</div>
						</form>
			</div>
		</div>
	</div>
	</header>
	
	<article>
	
		<div class="container text-center text-light">
			<h2 class="mt-5 mb-3"> Dzięki tej aplikacji z dużą łatwością zapanujesz nad swoim budżetem domowym. Oto kilka cytatów, które zmotywują Cię do oszczędzania: </h2>
			
			<div class="mt-5 bg-success p-2" style="--bs-bg-opacity: .5;">
				 <h3>Ayn Rand  -amerykańska pisarka i filozof:</h3> <br/>
				<i class="lead">„Jest tylko jeden sposób, który pozwoli ci zostać bogatym człowiekiem: wydawaj mniej, niż zarabiasz, a różnicę inwestuj” </i>
			</div>
			
			<div class="mt-3 bg-success p-2" style="--bs-bg-opacity: .5;">
				 <h3>Warren Buffett - amerykański inwestor giełdowy,przedsiębiorca i filantrop: </h3><br/>
				<i class="lead"> „Jeśli kupujesz rzeczy, których nie potrzebujesz, wkrótce będziesz musiał sprzedawać rzeczy, które są ci niezbędne” –  </i>
			</div>
			
			<div class="mt-3 bg-success p-2" style="--bs-bg-opacity: .5;">
				<h3> Clare B. Luce - amerykańska pisarka, polityk, ambasador USA: </h3><br/>
				<i class="lead"> „Szczęścia nie można kupić za pieniądze, ale pieniądze mogą zapewnić niesamowity komfort w czasach nieszczęścia”   </i>
			</div>
			
			<div class="mt-3 bg-success p-2" style="--bs-bg-opacity: .5;">
				<h3> Kamila Rowińska - dyplomowany coach,  trenerka, master facilitator oraz inwestorka:</h3> <br/>
				<i class="lead"> „Chcąc osiągnąć stabilizację finansową, musisz zmienić nawyki! Oszczędzanie i inwestowanie nie zaczyna się wtedy, gdy już kupisz wszystko, czego pragniesz”  </i>
			</div>
			
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