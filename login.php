<?php
	
	session_start();
	
	if((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
	$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		throw new Exception (mysqli_connect_errno());
	}
	else
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$email = htmlentities($email, ENT_QUOTES,"UTF-8");
			
		if($rezultat = $polaczenie->query(sprintf("SELECT amount,name FROM incomes, incomes_category_assigned_to_users WHERE ")))
		
		{
			
			$ilu_userow = $rezultat->num_rows;
			
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if(password_verify($password,$wiersz['password']))
				{
				$_SESSION['zalogowany'] = true;
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['id'] = $wiersz['id'];
			
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				
				header('Location: menu.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style="color:red"> Nieprawidłowy email lub hasło!</span>';
					header('Location: index.php');
				}
			
			}else
			{
				$_SESSION['blad'] = '<span style="color:red"> Nieprawidłowy email lub hasło!</span>';
				header('Location: index.php');
			}
		
		}
		else
		{
			throw new Exception ($polaczenie->error);
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