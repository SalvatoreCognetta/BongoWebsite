function show(id) {
	document.getElementById(id).style.display = 'block';
};

function hide(id) {
	document.getElementById(id).style.display = 'none';
	document.getElementById('price-input').disabled="disabled";
};
