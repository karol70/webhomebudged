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
	wynagrodzenie = parseInt(document.getElementById("wynagrodzenie").innerText);
	odsetki = parseInt(document.getElementById("odsetki").innerText);
	 allegro = parseInt(document.getElementById("allegro").innerText);
	 inne = parseInt(document.getElementById("inne").innerText);
	suma = wynagrodzenie + odsetki + allegro + inne;
	document.getElementById("suma").innerHTML = suma;	
}

	
	