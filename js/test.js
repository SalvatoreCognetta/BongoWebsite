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
}