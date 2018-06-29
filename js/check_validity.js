var now = new Date(Date.now());

var year = now.getFullYear();
year = year.toString();

var month = now.getMonth() + 1;
if (month < 10)
	month = '0' + month.toString();
else
	month = month.toString();

var day = now.getDate();
if (day < 10)
	day = '0' + day.toString();
else
	day = day.toString();

var date = year + "-" + month + "-" + day;
document.getElementById('date-input').min = date;



var submit = document.getElementById('btn-submit');

submit.onclick = function () {
	var city = document.getElementById('city_input');
	if (!city.value.match(/^[a-zA-Z\s]*$/) && city.value != "") {
		console.log("Il luogo non rispetta l'espressione regolare.");
		city.setCustomValidity("Solo lettere e spazi.");
	}

	var radio = document.getElementById("radioChoice2");
	if (radio.checked) {
		var price = document.getElementById("price-input");
		if (price.value == "") {
			console.log("Prezzo non inserito");
			price.setCustomValidity("Inserire un valore.");
		}
	}

};

