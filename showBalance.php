<?php
	
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:index.php');
		exit();
	}
	
	if(isset($_GET['biezacymiesiac']))
	{
		
		$biezacymiesiac = date('m');
		$biezacyrok = date('Y');
		$iloscdni = date('t');
		
		$_SESSION['dataod'] = "$biezacyrok".'-'."$biezacymiesiac".'-01';
		$_SESSION['datado'] = "$biezacyrok".'-'."$biezacymiesiac".'-'."$iloscdni";
		

	}
	if(isset($_GET['poprzednimiesiac']))
	{
		$poprzednimiesiac = date('m') -1;
		if($poprzednimiesiac < 10)
		{
			$poprzednimiesiac = '0'."$poprzednimiesiac";
		}
		$iloscdnipoprzmies = date('t', strtotime("-1 MONTH"));
		if($poprzednimiesiac == 12)
		{
		$rok = date('Y') -1;
		}
		else $rok = date('Y');
		
		$_SESSION['dataod'] =  "$rok".'-'."$poprzednimiesiac".'-01';
		$_SESSION['datado'] =  "$rok".'-'."$poprzednimiesiac".'-'."$iloscdnipoprzmies";
		
		
	}
	if(isset($_GET['biezacyrok']))
	{
		$biezacyrok = date('Y');
		$_SESSION['dataod'] = "$biezacyrok".'-01-01';
		$_SESSION['datado'] = "$biezacyrok".'-12-31';
		
	}
	
	if(isset($_POST['dataod']) && ($_POST['datado'])) 
	{
		$_SESSION['dataod'] = $_POST['dataod'];
		$_SESSION['datado'] = $_POST['datado'];	
		
		if(($_SESSION['dataod']) > ($_SESSION['datado']))
		{
			$_SESSION['e_daty'] = "<h2 class='text-center mt-5 text-uppercase'>"."Wprowadzono błędny okres. Data ".$_SESSION['dataod']." jest większa od ".$_SESSION['datado']."</h2>";
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
						<a class="nav-link" href="menu.php"> Strona główna </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link " href="addIncome.php"> Dodaj przychód </a>
					</li>
					
					<li class="nav-item ">
						<a class="nav-link " href="addExpense.php"> Dodaj wydatek </a>
					</li>
					
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
						<form method="post">
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
		
		<div class="container mx-auto text-light font-18">
		<?php
		if(isset($_SESSION['e_daty']))
			{
				echo '<div class="error text-center">'.$_SESSION['e_daty'].'</div>';
				unset($_SESSION['e_daty']);
			}	
			else
			{
				echo "<h2 class='text-center mt-5 text-uppercase'>"."Bilans przychodów i wydatków od ".$_SESSION['dataod']." do ".$_SESSION['datado']."</h2>";
			}
		?>
				
			<h5 class="h3 mx-auto text-center text-uppercase bg-success mt-3  col-4 col-lg-3"> Przychody </h5>
		<div class="col-sm-8 col-lg-6 mb-3 mx-auto">		
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
				$id =$_SESSION['id']; 
				$dataod = $_SESSION['dataod'];
				$datado =$_SESSION['datado'] ;
				
				$wynik = $polaczenie->query("SELECT name AS kategoria, SUM(amount) AS suma FROM incomes,incomes_category_assigned_to_users AS cat WHERE incomes.user_id = '$id' AND cat.id = incomes.income_category_assigned_to_user_id AND date_of_income BETWEEN '$dataod' AND '$datado' GROUP BY name DESC");
				if(($wynik->num_rows)>0)
				{
					echo "<table class ='table bg-success table-striped table-bordered' cellpadding =\"2\" border =1 style='--bs-bg-opacity: .75;'>";
					echo '<thead class="thead-dark">';
					echo "<th>"."Kategoria"."</th>";
				echo "<th class='text-center'>"."Suma [PLN]"."</th>";
					echo "</thead>";
					
					while ($r = $wynik->fetch_assoc())
					{
						echo "<tr>";
						echo "<td style='width:50%;'>".$r['kategoria']."</td>";
						echo "<td class='text-center'>".$r['suma']."</td>";
						echo "</tr>";
					}
					$wyniksuma = $polaczenie->query("SELECT SUM(amount) AS suma FROM incomes,incomes_category_assigned_to_users WHERE incomes.user_id = $id AND incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id  AND date_of_income BETWEEN '$dataod' AND '$datado'");
					$s = $wyniksuma->fetch_assoc();
					echo "<tr>";
					echo "<td style='width:50%;'><h4>"."SUMA"."</h4></td>";
					echo "<td class='text-center' id='sumaprzychodow'><h4>".$s['suma']."</h4></td>";
					echo "</tr>";
					echo "</table>";
					
				}
				else {
					echo "<h3 class='text-center mt-1 mb-2' style='color:red;'>"."Brak przychodów w wybranym okresie"."</h2>";
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
		</div>	
			
			<h5 class="h3 mx-auto text-center text-uppercase bg-success mt-3  w-25"> Wydatki </h5>
			
			
		<div class=" col-sm-8 col-lg-6 mb-3 mx-auto">
			
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
				$id =$_SESSION['id']; 
				$dataod = $_SESSION['dataod'];
				$datado =$_SESSION['datado'] ;
				
				$wynik = $polaczenie->query("SELECT name AS kategoria, SUM(amount) AS suma FROM expenses,expenses_category_assigned_to_users AS cat WHERE expenses.user_id = '$id' AND cat.id = expenses.expense_category_assigned_to_user_id AND date_of_expense BETWEEN '$dataod' AND '$datado' GROUP BY name DESC");
				if(($wynik->num_rows)>0)
				{
					echo "<table class ='table bg-success table-striped table-bordered' cellpadding =\"2\" border =1 style='--bs-bg-opacity: .75;'>";
					echo '<thead class="thead-dark">';
					echo "<th>"."Kategoria"."</th>";
					echo "<th class ='text-center'>"."Suma [PLN]"."</th>";
					echo "</thead>";
					
					while ($r = $wynik->fetch_assoc())
					{
						echo "<tr>";
						echo "<td style='width:50%;' >".$r['kategoria']."</td>";
						echo "<td class='text-center'>".$r['suma']."</td>";
						echo "</tr>";
					}
					$wyniksuma = $polaczenie->query("SELECT SUM(amount) AS suma FROM expenses,expenses_category_assigned_to_users WHERE expenses.user_id = $id AND expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id  AND date_of_expense BETWEEN '$dataod' AND '$datado'");
					$s = $wyniksuma->fetch_assoc();
					echo "<tr>";
					echo "<td style='width:50%;'><h4>"."SUMA"."</h4></td>";
					echo "<td class='text-center' id='sumawydatkow'><h4>".$s['suma']."</h4></td>";
					echo "</tr>";	
					echo"</table>";
					unset ($_SESSION['dataod']);
					unset ($_SESSION['datado']);
				}
				else 
					echo "<h3 class='text-center mt-1 mb-2' style='color:red;'>"."Brak wydatków w wybranym okresie"."</h2>";
				

				$polaczenie->close();
			}
		}
	
		catch (Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		} 
				
	    ?>
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

			<div class="bg-success text-center mt-5 text-uppercase"id ="bilans">
				
			</div>
		</div>
		<script>
		function checkBalance()
		{
			var sumaprzychodow = parseInt(document.getElementById("sumaprzychodow").innerText);
			var sumawydatkow = parseInt(document.getElementById("sumawydatkow").innerText);
			
			
			if(sumaprzychodow > sumawydatkow)
			{
				var roznica = sumaprzychodow - sumawydatkow;
				document.getElementById("bilans").innerHTML = "Bilans: "+roznica+"PLN  Gratulacje. Świetnie zarządzasz finansami!";
			}
			else
			{
				var roznica = sumawydatkow - sumaprzychodow;
				document.getElementById("bilans").innerHTML = "Bilans: -"+roznica+"PLN  Uważaj, wpadasz w długi!";
			}
		}
		</script>
		
	</article>
	
	<footer>
		
		<div class="text-center mt-5">
			Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
		</div>
		
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script  src ="bootstrap/bootstrap.min.js"></script>
</body>