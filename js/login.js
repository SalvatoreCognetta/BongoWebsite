//Funzione per la chiusura del login form alla pressione del tasto esc
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if (evt.keyCode == 27) { //27 is the code for escape
		var form = document.getElementById("test");
		form.className += ' animate-out ';
		setTimeout(() => {
			document.getElementById("id01").style.display = 'none';
			form.className = 'modal-content animate ';
		}, 600);
	}
};