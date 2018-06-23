// window.addEventListener("load", function(){
// 	// Add a keyup event listener to our input element
// 	document.getElementById('city_input').addEventListener("keyup", function(event){hinter(event)});
// 	// create one global XHR object 
// 	// so we can abort old requests when a new one is make
// 	// window.hinterXHR = new XMLHttpRequest();
// });

// // Autocomplete for form
// function hinter(event) {
// 	var input = event.target;
// 	var list = document.getElementById('cities_list');
	
	


// 	if (input.value.length == 0 ) { 
// 		return;
// 	} else { 
// 		while(list.hasChildNodes()) {
// 			list.removeChild(list.firstChild);
// 		}
// 		var value = input.value.toLowerCase();
// 		var hint = [];
// 		for (var index = 0, match = 0; index < comuni.length && match < 10; index++) {
// 			var str = comuni[index].toLowerCase();
// 			str = str.substr(0, value.length);
// 			if(str.includes(value)) {

// 				hint.push(comuni[index]);
// 				match++;
// 			}
// 		}


// 		for(var i = 0; i < hint.length && i < 10; i++) {
// 			var option = document.createElement('option');
// 			option.value = hint[i];
// 			list.appendChild(option);
// 		}
// 	}
// }


var list = document.getElementById('cities_list');

for(var i = 0; i < comuni.length; i++) {
	var option = document.createElement('option');
	option.value = comuni[i];
	list.appendChild(option);
}
