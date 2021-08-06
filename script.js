function showDateChoose()
{
	document.getElementById("datechoose").style.display = 'block';
	
}

function sumOfIncomes()
{
	var wynagrodzenie;
	var odsetki;
	var allegro;
	var inne;
	var suma;
	wynagrodzenie = document.getElementById("wynagrodzenie").value;
	odsetki = document.getElementById("odsetki").value;
	 allegro = document.getElementById("allegro").value;
	 inne = document.getElementById("inne").value;
	suma = wynagrodzenie + odsetki + allegro + inne;

	document.getElementById("suma").innerHTML = suma;	
}

	
	