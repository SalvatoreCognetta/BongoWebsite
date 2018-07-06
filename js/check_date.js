var now = new Date(Date.now());

var year = now.getFullYear();
year = year.toString();

var month = now.getMonth() + 1;
if (month < 10)
	month = '0' + month.toString();
else
	month = month.toString();

var day = now.getDate();
if (day < 10)
	day = '0' + day.toString();
else
	day = day.toString();

var date = year + "-" + month + "-" + day;
document.getElementById('date-input').min = date;