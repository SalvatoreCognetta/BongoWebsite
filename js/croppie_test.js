function readFile(input) {
	if (input.files && input.files[0]) {
	  var reader = new FileReader();
  
	  reader.onload = function (e) {
		$('#main-cropper').croppie('bind', {
		  url: e.target.result
		});
		$('.actionDone').toggle();
		$('.actionUpload').toggle();
	  }
  
	  reader.readAsDataURL(input.files[0]);
	}
}


document.getElementById('profile-img').onchange(function() {
	readFile(this);
});
document.getElementById('profile-img').onclick(function() {
	document.getElementById('profile-img').toggle();
	document.getElementById('profile-img').toggle();
});