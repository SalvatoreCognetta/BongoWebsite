var list = document.getElementById('cities_list');
var nav_list = document.getElementById('nav_cities_list');

// for(var i = 0; i < comuni.length || i < 50; i++) {
// 	var option = document.createElement('option');
// 	option.value = comuni[i];
// 	list.appendChild(option);
// }




var input = document.getElementById('city_input');
var nav_input = document.getElementById('nav_city_input');
if(input) {
	input.onkeyup =  function(event) {
		if(event.keyCode != "38" && event.keyCode != "40") { //se l'utente scorre nella lista mostrata questa non deve essere aggiornata
			var sublist = comuni;
			var sublisttemp = [];
			while (list.firstChild) {
					list.removeChild(list.firstChild);
			}

			var len = input.value.length;
			console.log(len + input.value);
			if(event.key === "Backspace" || event.key === "Delete"){	//Se l'utente ha premuto il tasto Backspace
				console.log('Backspace Key Pressed');
				sublist = comuni;
				
			}
			sublist.forEach(function(element, index){
				var substring = element.substr(0, len).toLocaleLowerCase();
				// console.log(substring);
				if(substring.indexOf(input.value) != -1){
					sublisttemp.push(element);
					// console.log("sublist[" + index + "]=" + element + ";");
				} else {
				}
			});

			sublist = sublisttemp;
			sublisttemp = [];
			// console.log(sublist);
			for(var i = 0; i < sublist.length || i < 50; i++) {
				// console.log(sublist.length)
				var option = document.createElement('option');
				option.value = sublist[i];
				list.appendChild(option);
			}
		}
	}
}

if(nav_input){
	nav_input.onkeyup = function(event) {
		if(event.keyCode != "38" && event.keyCode != "40") { //se l'utente scorre nella lista mostrata questa non deve essere aggiornata

			var sublist = comuni;
			var sublisttemp = [];
			while (nav_list.firstChild) {
					nav_list.removeChild(nav_list.firstChild);
			}

			var len = nav_input.value.length;
			console.log(len + nav_input.value);
			if(event.key === "Backspace" || event.key === "Delete"){	//Se l'utente ha premuto il tasto Backspace
				console.log('Backspace Key Pressed');
				sublist = comuni;
				
			}
			sublist.forEach(function(element, index){
				var substring = element.substr(0, len).toLocaleLowerCase();
				// console.log(substring);
				if(substring.indexOf(nav_input.value) != -1){
					sublisttemp.push(element);
					// console.log("sublist[" + index + "]=" + element + ";");
				} else {
				}
			});

			sublist = sublisttemp;
			sublisttemp = [];
			// console.log(sublist);
			for(var i = 0; i < sublist.length || i < 50; i++) {
				// console.log(sublist.length)
				var option = document.createElement('option');
				option.value = sublist[i];
				nav_list.appendChild(option);
			}
		}
	}
}


