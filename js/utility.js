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
				document.getElementById('croppied-wrapper').style.display = 'block';
			} else {
				// An error occured :(
			}
		}
	};

console.log(id_evento);
	// Set up and make the request.
	request.open('GET', './participants.php?id=' + id_evento, true);
	request.send();
}

