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
function setTodayDate()
{
	var date = new Date();

	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	if (month < 10) month = "0" + month;
	if (day < 10) day = "0" + day;

	var today = year + "-" + month + "-" + day;       
	//document.getElementById("data").value = today;
	return today;
}
	
	