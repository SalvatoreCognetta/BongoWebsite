function show(id) {
	document.getElementById(id).style.display = 'block';
	document.getElementById('price-input').disabled = "";
};

function hide(id) {
	document.getElementById(id).style.display = 'none';
	document.getElementById('price-input').disabled = "disabled";
};
