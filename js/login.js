//Funzione per la chiusura del login form alla pressione del tasto esc
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if (evt.keyCode == 27) { //27 is the code for escape
		var form = document.getElementById("login-container");
		form.className += ' animate-out ';
		console.log("Esc premuto.");
		setTimeout(() => {
			document.getElementById("login-container").style.display = 'none';
			form.className = 'login-container modal animate ';
		}, 600);
	}
};