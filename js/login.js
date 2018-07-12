//Funzione per la chiusura del login form alla pressione del tasto esc
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if (evt.keyCode == 27 && document.getElementById("login-container") != null) { //27 is the code for escape
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
	console.log("Form activate.");
	if(id === "signin") {
		document.getElementById("signin").className = "active-form";
		document.getElementById("login").className = "";

		document.getElementById("login-form").style.display = 'none';
		document.getElementById("signin-form").style.display = 'flex';
	} else if(id === "login") {
		document.getElementById("login").className = "active-form";
		document.getElementById("signin").className = "";

		document.getElementById("signin-form").style.display = 'none';
		document.getElementById("login-form").style.display = 'flex';	
	}	
};


function checkLogin(form) {
	if(RegExp(/^[a-zA-Z0-9_-]*$/).test(form.login_username.value) == false) {
		alert("L'username deve contenere solo lettere, numeri o trattini");
		return false;
	}

	if(RegExp(/^[a-zA-Z0-9_-]*$/).test(form.login_psw.value) == false) {
		alert("La password deve contenere solo lettere, numeri o trattini");
		return false;
	}

	return true;
}


function checkSignup(form) {
	if(RegExp(/^[a-zA-Zà-ù\s']*$/).test(form.signup_fullname.value) == false) {
		alert("Il nome deve contenere solo lettere o spazi");
		return false;
	}

	if(RegExp(/^[a-zA-Z0-9_-]*$/).test(form.signup_username.value) == false) {
		alert("L'username deve contenere solo lettere, numeri o trattini");
		return false;
	}

	if(RegExp(/^[a-zA-Z0-9_-]*$/).test(form.singup_psw.value) == false) {
		alert("La password deve contenere solo lettere, numeri o trattini");
		return false;
	}

	if(RegExp(/\S+@\S+\.\S+/).test(form.signup_email) == false) {
		alert("Email non valida.");
		return false;
	}

	if(form.signup_email !== form.signup_emailconfim) {
		alert("Le email devono coincidere.");
		return false;
	}

	return true;
}
