# Proprietà

## Attributi defer e async
L'attributo *defer* dice al browser di eseguire lo script solo quando il documento HTML è completamente analizzato e interpretato.  
![defer](./img/Defer-Execution.png)  
L'attributo *async*, invece, è utilizzato per indicare al browser che il file script può essere eseguito in modo asincrono. Cioè il parser HTML non deve necessariamente stopparsi quando incontra il tag script (in modo da caricacare, fetch, il file) ed eseguirlo. Infatti l'esecuzione dello script può avvenire in qualsiasi momento in cui lo script diventa pronto.  
![async](./img/Async-Execution.png)  
[async vs defer](https://bitsofco.de/async-vs-defer/)

# Funzioni per l'output
Per accedere ad un elemento HTML, si può utilizzare il metodo `document.getElementById(id)`. Per l'output invece si utilizza:
- `innerHTML=...`: proprietà per scrivere all'interno dell'elemento HTML selezionato con il metodo precedente;
- `document.write("...")`: utilizzata principalmente per test. Usare questa proprietà dopo che il documento HTML è stato completamente caricato, eliminerà tutto l'HTML esistente;
- `window.alert("...")`: alert box per visualizzare i dati;
- `console.log("...")`: utilizzata per debugging.