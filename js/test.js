var el = document.getElementById('upload-croppie');
var vanilla = new Croppie(el, {
  // enableExif: true,
  viewport: {
    width: 177,
    height: 100,
    type: 'square'
  },
  boundary: {
    width: 200,
    height: 200
  }
})

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onloadend = function() {
      el.style.display = "block";

      vanilla.bind({
        url: reader.result
      });

      document.getElementById('btn-croppie-result').style.display = "block";
    }

    reader.readAsDataURL(input.files[0]);
    

  }
}



function getResult(){
  vanilla.result({type: 'rawcanvas',  circle: false, format: 'png'}).then(function(result) {
    var existing = document.getElementById('result-img');
    console.log(result);
    if(existing.children.length > 0) {
      existing.removeChild(existing.children[0]);
    } 
    document.getElementById('result-img').appendChild(result);
    document.getElementById("croppied-wrapper").style.display = "block";
    document.getElementById("hidden-img").value = result.toDataURL('image/png');
    console.log(result.toDataURL('image/jpeg'));
  })
}

