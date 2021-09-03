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
<body >

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
						<a class="nav-link" href="menu.html"> Strona główna </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="addIncome.html"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item ">
						<a class="nav-link " href="addExpense.html"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Przeglądaj bilans
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="showBalance.html">Bieżący miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.html">Poprzedni miesiąc</a></li>
						<li><a class="dropdown-item" href="showBalance.html">Bieżący rok</a></li>					
						<li><button type="button" class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#Modal">Niestandardowy</button></li>
					  </ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"> Ustawienia </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"> Wyloguj się </a>
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
		
		<div class="container mx-auto text-light font-18">
		<h2 class="text-center mt-5 text-uppercase"> Przeglądaj bilans</h2>
				
			<h5 class="h3 mx-auto text-center text-uppercase bg-success mt-3  col-4 col-lg-3"> Przychody </h5>
				
			<div class="row mx-2">
				<div class="col-6 col-lg-3">
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> <i class="icon-money-1"></i>  Wynagrodzenie </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> <i class="icon-percent"></i>  Odsetki bankowe </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> <i class="icon-basket"></i>  Sprzedaż na allegro </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> <i class="icon-star"></i>  Inne </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> Suma </div>
				</div>
				
				<div class=" col-6 col-lg-3 text-center">
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" ><div id="wynagrodzenie">5000</div></div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" ><div id="odsetki">100</div> </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" ><div id="allegro">450</div> </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" ><div id="inne">0</div> </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><div id="suma"></div> </div>
					<script >
					sumOfIncomes();		
					</script>
				</div>
			</div>
			
			
			<h5 class="h3 mx-auto text-center text-uppercase bg-success mt-3  w-25"> Wydatki </h5>
			
			
			<div class="row mx-2">
			
				<div class="col-6 col-lg-3">
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-food" ></i>  Jedzenie</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-home"></i>  Mieszkanie</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-aboveground-rail"></i>  Transport</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-mobile"></i>  Telekomunikacja</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-hospital"></i>  Opieka zdrowotna</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-t-shirt"></i>  Ubranie</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-bath"></i>  Higiena</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-child"></i>  Dzieci</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-smile"></i>  Rozrywka</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-flight"></i>  Wycieczka</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-college"></i>  Szkolenia</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-book-open"></i>  Książki</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-money"></i>  Oszczędności</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-hourglass"></i>  Na emeryturę</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-bank"></i>  Spłata długów</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-handshake-o"></i>  Darowizna</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"><i class="icon-star"></i>  Inne wydatki</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;"> Suma </div>
				</div>
			
				<div class="col-6 col-lg-3 text-center">
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="jedzenie"> 200 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="mieszkanie"> 1500 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="transport"> 200 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="telekomunikacja"> 100 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="zdrowie"> 50 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="ubrania"> 100 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="higiena"> 100 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="dzieci"> 0</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="rozrywka"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="wycieczka"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="szkolenia"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="książki"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="oszczędności"> 50</div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="emerytura"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="długi"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="darowizna"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="innewydatki"> 0 </div>
					<div class="bg-success my-1" style="--bs-bg-opacity: .75;" id="sumawyd"> 2300 </div>
					
				</div>
			
			
			<div class="col-4 col-lg-6" id="piechart"></div>
			</div>
	<script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		
        var data = google.visualization.arrayToDataTable([
          ['Kategorie wydatkow', 'Zl / wybrany okres'],
          ['Jedzenie', 200],
		  ['Mieszkanie', 1500],
		  ['Telekomunikacja', 100],
		  ['Zdrowie', 50],
		  ['Ubrania', 100],
		  ['Higiena', 100],
		  ['Dzieci', 0],
		  ['Rozrywka', 0],
		  ['Wycieczka', 0],
		  ['Szkolenia', 0],
		  ['Książki', 0,],
		  ['Oszczędności', 50],
		  ['Emerytura', 0],
		  ['Długi', 0],
		  ['Darowizna', 0],
		  ['Inne wydatki', 100]
        ]);

        var options = {
	
		  backgroundColor: "transparent",
		fontSize: 16
		    
        };
		
		 
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

			<div class ="bilans">
				<p class="bg-success text-center mt-5 text-uppercase">Bilans: </p>
			</div>
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