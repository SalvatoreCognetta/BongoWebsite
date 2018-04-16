# Proprietà

## Attributi defer e async
L'attributo *defer* dice al browser di eseguire lo script solo quando il documento HTML è completamente analizzato e interpretato.  
![defer](./img/Defer-Execution.png)  
L'attributo *async*, invece, è utilizzato per indicare al browser che il file script può essere eseguito in modo asincrono. Cioè il parser HTML non deve necessariamente stopparsi quando incontra il tag script (in modo da caricacare, fetch, il file) ed eseguirlo. Infatti l'esecuzione dello script può avvenire in qualsiasi momento in cui lo script diventa pronto.  
![async](./img/Async-Execution.png)  
[async vs defer](https://bitsofco.de/async-vs-defer/)