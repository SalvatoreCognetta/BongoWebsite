function show(id) {
	document.getElementById(id).style.display = 'block';
	document.getElementById('price-input').disabled = "";
};

function hide(id) {
	document.getElementById(id).style.display = 'none';
	document.getElementById('price-input').disabled = "disabled";
};


function show_participants(id_evento) {
	// Create a new XMLHttpRequest.
	var request = new XMLHttpRequest();

	// Handle state changes for the request.
	request.onreadystatechange = function(response) {
		if (request.readyState === 4) {
			if (request.status === 200) {
				var participants = JSON.parse(request.responseText);
				var len = participants.length;
				var list = document.getElementById('participants');
				console.log(request.responseText);

				for(var i = 0; i < len; i++) {
					var li = document.createElement('li');
					li.innerHTML = participants[i];
					// console.log(participants[i]);
					list.appendChild(li);
				}
				document.getElementById('list-wrapper').style.display = 'block';
			} else {
				// An error occured :(
			}
		}
	};

	// Set up and make the request.
	request.open('GET', './participants.php?id=' + id_evento, true);
	request.send();
}


function initDate() {
	var now = new Date();

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
	document.getElementById('date-input').value = date;
	document.getElementById('date-input').min = date;
}

function checkInputEvent() {
	var error = false;
	var name = document.getElementById('name');
	if(!RegExp(/^[a-zA-Z0-9à-ù\s]*$/).test(name.value)) {
		name.style.borderColor = 'red';
		name.title = "Inserire un titolo contenente solo lettere e numeri.";
		console.log("Titolo non corretto");
		error = true;
	} else {
		name.style.borderColor = 'rgb(216, 216, 216)';
	}

	var city = document.getElementById('city_input');
	if (!city.value.match(/^[a-zA-Z\s]*$/)) {
		city.style.borderColor = 'red';

		city.title = "Inserire una citt&agrave; contenente solo lettere.";

		console.log("Il luogo non rispetta l'espressione regolare.");
		error = true;
	} else {
		city.style.borderColor = 'rgb(216, 216, 216)';
	}

	var radio = document.getElementById("radioChoice2");
	if (radio.checked) {
		var price = document.getElementById("price-input");
		if (price.value == "") {
			console.log("Prezzo non inserito");
			price.title = "Inserire un valore valido";
			error = true;
		}
	} else {
		if(!document.getElementById('radioChoice1').checked) {
			var p = document.createElement('p');
			p.innerHTML	= ' *Effettuare una scelta';
			p.style.color = 'red';
			document.getElementById('radioChoices').appendChild(p);
			error = true;
		}
	}

	var cat = document.getElementById("categories");
	if (cat.value == "") {
		cat.style.color = 'red';
		cat.title = "Scegliere una categoria";
		error = true;
	}
	return !error;
}

var submit = document.getElementById('btn-submit');

function checkCreateEvent() {
	var check = false;

	check = checkInputEvent();

	var img = document.getElementById('hidden-img');
	if(img.value === "") {
		
		console.log("Immagine non inserita");
		if(document.getElementById('btn-croppie-result').style.display == 'none') {
			document.getElementById('file-choice').focus();
			document.getElementById('file-choice').title = "Selezionare un file.";		
		} else {
			document.getElementById('btn-croppie-result').focus();
			document.getElementById('btn-croppie-result').title = "Ritagliare l'immagine.";
		}
		
		return false;
	}

	return check;
};

function checkProfileInfo() {
	var nick = document.getElementsByName('username')[0];
	var name = document.getElementsByName('name')[0];
	var email = document.getElementsByName('email')[0];

	var error= false;



	if(!RegExp(/^[a-zA-Z0-9\._-]*$/).test(nick.value)) {
		console.log("Nick non accettato");
		nick.title = "Sono accettati solo lettere, numeri, trattini e punti.";
		nick.style.borderColor = 'red';
		error = true;
	} else {
		nick.style.borderColor = 'rgb(216, 216, 216)';
	}

	if(!RegExp(/^[a-zA-Zà-ù\s']*$/).test(name.value)) {
		console.log("Nick non accettato");
		name.title = "Nome non valido.";
		name.style.borderColor = 'red';
		error = true;
	} else {
		name.style.borderColor = 'rgb(216, 216, 216)';
	}

	if(!RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(email.value)) { //RFC 5322 Official Standard
		console.log("Email non accettato");
		email.title = "Email non valida.";
		email.style.borderColor = 'red';
		error = true;
	} else {
		email.style.borderColor = 'rgb(216, 216, 216)';
	}
	return !error;

}

function checkSearch() {
	var error = false;
	var title = document.getElementById('title');

	if(!RegExp(/^[a-zA-Z0-9à-ù\s]*$/).test(title.value)) {
		title.style.borderColor = 'red';
		title.title = "Inserire un titolo contenente solo lettere e numeri.";
		console.log("Titolo non corretto");
		error = true;
	} else {
		title.style.borderColor = 'rgb(216, 216, 216)';
	}

	return !error;
}