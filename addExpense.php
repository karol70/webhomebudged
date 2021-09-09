<?php
	
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:index.php');
		exit();
	}
	
	if(isset ($_POST['kwota']))
	{
	
			$all_OK = true;
			$kwota = $_POST['kwota'];
			$kwota = str_replace(',','.',$kwota);
		
			if (!is_numeric($kwota))
			{
				$all_OK = false;
				$_SESSION['e_kwota'] = "Kwota może zawierać jedynie cyfry";
			}
			
			$znak = '.';
			$czywystepuje = strpos($kwota, $znak);
			
			if($czywystepuje === true)
			{
				$kwotanaczesci = explode(".",$kwota);
				
				if(strlen($kwotanaczesci[0])>6)
				{
					$all_OK = false;
					$_SESSION['e_kwota'] = "Maksymalna liczba cyfr przed przecinkiem wynosi 6";
				}	
				
				if(strlen($kwotanaczesci[1])>2)
				{
					$all_OK = false;
					$_SESSION['e_kwota'] = "Maksymalna liczba cyfr po przecinku wynosi 2";
				}
			}
			
			if(!isset($_POST['kategoria']))
			{
				$all_OK = false;
				$_SESSION['e_kategoria'] = "Wybierz kategorię";
			}
			
			else{
			$kategoria = $_POST['kategoria'];
			}
			
			$metoda = $_POST['metoda'];
			
			$data = $_POST['data'];
			
			
			$komentarz = $_POST['komentarz'];
			
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
				if($all_OK==true)
				{   
					$userid = $_SESSION['id'];
					
					$resultkatid = $polaczenie->query("SELECT id FROM expenses_category_assigned_to_users WHERE user_id = '$userid' AND name ='$kategoria'");
					$wierszkatid = $resultkatid->fetch_assoc();
					$katid = $wierszkatid['id'];
					
					$resultmetid = $polaczenie->query("SELECT id FROM payment_methods_assigned_to_users WHERE user_id = '$userid' AND name ='$metoda'");
					$wierszmetid = $resultmetid->fetch_assoc();
					$metid = $wierszmetid['id'];
											
					if ($polaczenie->query("INSERT INTO expenses VALUES(NULL, '$userid', '$katid', '$metid', '$kwota','$data','$komentarz')"))
					{
						$_SESSION['dodanywydatek']="Wydatek został dodany!";
						header('Location:addExpense.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
		
				$polaczenie->close();
			}
		}
	
	catch (Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
		echo '<br />Informacja developerska: '.$e;
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
	<script type="text/javascript" src ="script.js"></script>
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
						<a class="nav-link " href="addIncome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item ">
						<a class="nav-link active" href="addExpense.php"> Dodaj wydatek </a>
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
		
		 <form class="bg-success p-4 w-50 mx-auto " style="--bs-bg-opacity: .5;" method="post">
		
		 <h2 class="text-uppercase text-center mx-auto mb-4">Dodaj wydatek</h2>
		 <?php
			if (isset($_SESSION['dodanywydatek']))
			{
				echo '<div class ="text-center">'.$_SESSION['dodanywydatek'].'</div>';
				unset($_SESSION['dodanywydatek']);
			}
		 ?>

				<div class="form-inline col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase" for="kwota"> Kwota: </label>
					<input class="form-control" type="text" name="kwota" id="kwota">				
				</div>
				<?php
					if(isset ($_SESSION['e_kwota']))
					{
					 echo '<div class="error text-center">'.$_SESSION['e_kwota'].'</div>';
					unset($_SESSION['e_kwota']);
					}
				?>
				<div class="mt-3 col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase mb-1" > Metoda płatności: </label>
						<div class="form-check col-sm-8 col-lg-6 mb-3 " >
							<input class="form-check-input " type="radio" name="metoda" id="opt1" value="Gotówka" checked/>
							 <label class="form-check-label" for="opt1">Gotówka</label>
						</div>
							
						<div class="form-check col-sm-8 col-lg-6 mb-3 ">
							 <input class="form-check-input" type="radio" name="metoda" id="opt2" value="Karta debetowa"/>
							 <label class="form-check-label" for="opt2">Karta debetowa</label>	
						</div>
							
						<div class="form-check col-sm-8 col-lg-6 mb-3 ">
							<input class="form-check-input" type="radio" name="metoda" id="opt3" value="Karta kredytowa"/>
							<label class="form-check-label" for="opt3">Karta kredytowa</label>
						</div>
				</div>
				
				<div class="form-inline col-sm-8 col-lg-6 mb-3 mx-auto">
					<label class="text-uppercase" for="data"> Data: </label>
					<input class="form-control" type="date" name="data" id="data" >
				</div>
				<script>
					var date = new Date();

					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();

					if (month < 10) month = "0" + month;
					if (day < 10) day = "0" + day;

					var today = year + "-" + month + "-" + day;       
					document.getElementById("data").value = today;									
				</script>
				
				<div class="form-group mt-3 col-sm-8 col-lg-6 mx-auto">
					<label class="text-uppercase" for="kategoria"> Kategoria wydatku: </label>
					<select class="form-control" size="6" id="kategoria" name="kategoria">					
						<?php
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
								$userId = $_SESSION['id'];
								$kat = $polaczenie->query("SELECT name FROM expenses_category_assigned_to_users WHERE user_id = '$userId'");
							
							 while($pojkat = $kat->fetch_assoc())
							 {
								 $nazwakategorii = $pojkat['name'];
								echo '<option value='."$nazwakategorii".'>'."$nazwakategorii".'</option>';
							 }
								$polaczenie->close();
							}
						}
							
						catch (Exception $e)
						{
							echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
							echo '<br />Informacja developerska: '.$e;
						}
						
						?>
					</select>
					<?php
						if(isset ($_SESSION['e_kategoria']))
						{
						 echo '<div class="error text-center">'.$_SESSION['e_kategoria'].'</div>';
						unset($_SESSION['e_kategoria']);
						}
					?>
				</div>
				
					 <div class="form-group mt-3 col-sm-8 col-lg-6 mx-auto">
						<label class="text-uppercase" for="komentarz">Komentarz:</label>
						<textarea class="form-control" id="komentarz" rows="3" name="komentarz"></textarea>
					  </div>
			
				<div class="mt-3 mx-auto text-center">
					<input type="submit"  class="btn btn-success" value="Dodaj"/>
					<a href="addExpense.php"><button type="button" class="btn btn-warning">Anuluj</button></a>
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