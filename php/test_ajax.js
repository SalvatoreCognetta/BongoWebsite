window.addEventListener("load", function(){
	// Add a keyup event listener to our input element
	document.getElementById('city_input').addEventListener("keyup", function(event){hinter(event)});
	// create one global XHR object 
	// so we can abort old requests when a new one is make
	// window.hinterXHR = new XMLHttpRequest();
});

// Autocomplete for form
function hinter(event) {
	var input = event.target;
	var list = document.getElementById('cities_list');
	
	while(list.hasChildNodes()) {
		list.removeChild(list.firstChild);
	}
	// minimum number of characters before we start to generate suggestions
	var min_characters = 0;

	if (input.value.length == 0 ) { 
		return;
	} else { 
		var value = input.value.toLowerCase();
		var hint = [];
		for (var index = 0; index < comuni.length || index < 10; index++) {
			// console.log(comuni[index]);
			var str = comuni[index].toLowerCase();
			str = str.substr(0, value.length);
			if(str.includes(value)) {
				hint.push(comuni[index]);
			}
		}

		for( var i = 0; i < hint.lenght || i < 10; i++) {
			var option = document.createElement('option');
			option.value = hint[i];
			console.log(option);
			list.appendChild(option);
		}
	}
}
