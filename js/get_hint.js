//Variabile contenente, per ogni lettera dell'alfabeto, l'indice del primo comune corrispondente che inizia con quella lettera

var first_city_index = [];
for(var i = 0; i < 26; i++) {
	first_city_index[i] = -1;
}

var len = comuni.length;
for(var i = 0; i < len; i++){
	// console.log(comuni[i].toLocaleLowerCase().charCodeAt(0)-97);
	var	j = comuni[i].toLocaleLowerCase().charCodeAt(0)-97;
	
	if(first_city_index[j] == -1){
			// console.log("Indice first_city_index[" + comuni[i].toLocaleLowerCase().charAt(0) + "] = " + i);
			first_city_index[j] = i;
	}
}
// console.log("test");


var input = document.getElementById('city_input');
var nav_input = document.getElementById('nav_city_input');
var oldValue = "";
var sublist = comuni;

if(input) {
	input.onkeyup = showhint;
}


if(nav_input){
	nav_input.onkeyup = showhint;
}




function showhint(event) {
	
	// if(event.keyCode != "38" && event.keyCode != "40") { //se l'utente scorre nella lista mostrata questa non deve essere aggiornata
	if(RegExp(/^[a-zA-Zà-ù\s']*$/).test(this.value) || event.keyCode != "38" && event.keyCode != "40"){
		var sublisttemp = [];

	 	var list = this.list;
		var len = this.value.length;

		console.log("Valore inserito: " + this.value);

		if(this.value.length == 0){
			console.log("E' stato cancellato tutto l'input, quindi e' inutile cercare comuni che corrispondono.");
			return;
		}

		if(oldValue === this.value) {
			console.log("Se l'input non e' variato, per qualsiasi motivo, e' inutile rifare la ricerca.");
			return;
		}

		while (list.firstChild) {
			list.removeChild(list.firstChild);
		}

		if(oldValue !== this.value.substring(0, oldValue.length) ) {
			console.log("Gli input non coincidono, quindi l'input e' stato eliminato parzialmente o totalmente.");
			sublist = comuni;
			
		}

		//Variabile utile per ridurre il numero di cicli del foreach successivo: se è stato trovato un comune, match = true; inoltre, se le prime n lettere del comune successivo non corrispondono con l'input dell'utente, allora stoppa il for, poichè di sicuro non ci saranno altri comuni.
		var match = false; 
		var list_len = sublist.length;

		//Se l'input contiene solo una lettera invece che scorrere tutta la lista dei comuni, parte dal primo comune che ha come prima lettera l'input
		var index = 0;
		if(this.value.length == 1) { 
			var	letter_index = this.value.toLocaleLowerCase().charCodeAt(0) - 97;
			console.log("Indice: " + first_city_index[letter_index]);
			index = first_city_index[letter_index];
		}
		
		// var cicli = 0; //Utile per debug
		console.log("Lunghezza lista iniziale: " + list_len);
		for(; index < list_len; index++){
			// cicli++;
			var element = sublist[index];
			// console.log(element);
			var substring = element.substr(0, len).toLocaleLowerCase();
			if(substring.indexOf(this.value.toLocaleLowerCase()) != -1){
				match = true;
				sublisttemp.push(element);
				//  console.log("sublist[" + index + "]=" + element + ";");
			} else {
				if(match){
					break;
				}
			}
		}
		// console.log("Numero totale di cicli per la ricerca: " + cicli);

		sublist = sublisttemp;
		sublisttemp = [];
		console.log("L'array inizia da " + first_city_index[letter_index] + " ed e' lungo  " + sublist.length);

		for(var i = 0; i < sublist.length && i < 50; i++) {
			// console.log(sublist.length)
			var option = document.createElement('option');
			option.value = sublist[i];
			list.appendChild(option);
		}
		
		oldValue = this.value;
	}
}