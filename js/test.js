
var input_file = document.getElementById('upload-img');

// Create a new XMLHttpRequest.
var request = new XMLHttpRequest();

// Handle state changes for the request.
request.onreadystatechange = function(response) {
  if (request.readyState === 4) {
    if (request.status === 200) {
      console.log(request.responseText);
      // document.getElementById("hidden-img").value = request.responseText;

    }

      // Update the placeholder text.
  } else {
      // An error occured :(
  }
};

// Update the placeholder text.

//Per ottenere l'id dell'evento dall'array $_GET
var $_GET = {};
if(document.location.toString().indexOf('?') !== -1) {
    var query = document.location
                   .toString()
                   // get the query string
                   .replace(/^.*?\?/, '')
                   // and remove any existing hash string (thanks, @vrijdenker)
                   .replace(/#.*$/, '')
                   .split('&');
    console.log(query);
    for(var i=0, l=query.length; i<l; i++) {
       var aux = decodeURIComponent(query[i]).split('=');
       $_GET[aux[0]] = aux[1];
    }
}
//get the 'index' query parameter
var id= $_GET['id'];

// Set up and make the request.
request.open('GET', 'get_img.php?idevent=' + id, true);
request.send();