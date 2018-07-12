//Funzione per la chiusura del login form alla pressione del tasto esc
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if (evt.keyCode == 27) { //27 is the code for escape
		var form = document.getElementById("login-container");
		form.className += ' animate-out ';
		console.log("Esc premuto.");
		setTimeout( function() {
			document.getElementById("login-container").style.display = 'none';
			form.className = 'modal-container modal animate ';
		}, 600);
	}
};

function arrow_change(id) {
	var arrow = document.getElementById(id);
	if(arrow.className == "arrow-down") {
		arrow.src="../img/icon/arrow_drop_up_black_24px.svg";
		arrow.className="arrow-up";
		document.getElementById("drop-menu").style.display = 'block';
		console.log("Cambiata la freccia up in down.");
	} else {
		arrow.src="../img/icon/arrow_drop_down_black_24px.svg";
		arrow.className="arrow-down";
		document.getElementById("drop-menu").style.display = 'none';
		console.log("Cambiata la freccia down in up.");
	}
};

function activate_form(id) {
	if(id === "signin") {
		document.getElementById("signin").classList = "active-form";
		document.getElementById("login").classList = "";

		document.getElementById("login-form").style.display = 'none';
		document.getElementById("signin-form").style.display = 'flex';
	} else if(id === "login") {
		document.getElementById("login").classList = "active-form";
		document.getElementById("signin").classList = "";

		document.getElementById("signin-form").style.display = 'none';
		document.getElementById("login-form").style.display = 'flex';	
	}	
};