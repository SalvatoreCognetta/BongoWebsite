
// var el = document.getElementById('vanilla-demo');
// var vanilla = new Croppie(el, {
//     viewport: { width: 100, height: 100, type: 'circle' },
//     boundary: { width: 300, height: 300 },
//     enableOrientation: true
// });
// vanilla.bind({
//     url: '../img/party2.jpeg',
// });
//on button click



var up = document.getElementById('upload-demo');
var vanillaup = new Croppie(up, {
  enableExif: true,
  viewport: {
    width: 100,
    height: 100,
    type: 'circle'
  },
  boundary: {
    width: 200,
    height: 200
  }
})
vanillaup.result({
  circle:true
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onloadend = function() {
      up.style.display = "block";

      vanillaup.bind({
        url: reader.result
      });

      document.getElementById('upload-result').style.display = "inline-block";
    }

    reader.readAsDataURL(input.files[0]);
    

  }
}



function getResult(){
  vanillaup.result({type: 'rawcanvas',  circle: true, format: 'png'}).then(function(result) {
    var existing = document.getElementById('result-img');
    if(existing.children.length > 0) {
      existing.removeChild(existing.children[0]);
    } 
    document.getElementById('result-img').appendChild(result);
    document.getElementById("result-img").style.display = "block";
document.getElementById("hidden").value = result.toDataURL('image/png');
console.log(document.getElementById("hidden").value);
  })
}
