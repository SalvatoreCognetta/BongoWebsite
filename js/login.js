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
		form.login_username.style.borderColor = 'red';
		form.login_username.title = 'Username non valido';
		return false;
	} else {
		form.login_username.style.borderColor = 'rgb(216, 216, 216)';
	}

	return true;
}


function checkSignup(form) {
	if(RegExp(/^[a-zA-Zà-ù\s']*$/).test(form.signup_fullname.value) == false) {
		console.log("fullname: " + form.signup_fullname.value);

		form.signup_fullname.style.borderColor = 'red';
		form.signup_fullname.title = 'Nome non valido';
		
		return false;
	} else {
		form.signup_fullname.style.borderColor = 'rgb(216, 216, 216)';
	}

	if(RegExp(/^[a-zA-Z0-9_-]*$/).test(form.signup_username.value) == false) {
		console.log("username: " + form.signup_username.value);

		form.signup_username.style.borderColor = 'red';
		form.signup_username.title = 'Username non valido';
		
		return false;
	} else {
		form.signup_username.style.borderColor = 'rgb(216, 216, 216)';
	}


	if(!RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(form.signup_email.value)) { //RFC 5322 Official Standard
		console.log("email: " + form.signup_email.value);
		form.signup_email.style.borderColor = 'red';
		form.signup_email.title = 'Email non valida';

		return false;
	} else {
		form.signup_email.style.borderColor = 'rgb(216, 216, 216)';
	}

	if(form.signup_email.value !== form.signup_emailconfirm.value) {
		console.log("email: " + form.signup_emailconfirm.value);

		form.signup_emailconfirm.style.borderColor = 'red';
		form.signup_emailconfirm.title = 'Email non combaciano';

		return false;
	} else {
		form.signup_emailconfirmconfirm.style.borderColor = 'rgb(216, 216, 216)';

	}

	return true;
}
