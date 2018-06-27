var list = document.getElementById('cities_list');

for(var i = 0; i < comuni.length; i++) {
	var option = document.createElement('option');
	option.value = comuni[i];
	list.appendChild(option);
}
