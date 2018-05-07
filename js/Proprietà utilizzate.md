# Proprietà

## Attributi defer e async
L'attributo **defer** dice al browser di eseguire lo script solo quando il documento HTML è completamente analizzato e interpretato.  
![defer](./img/Defer-Execution.png)  
L'attributo **async**, invece, è utilizzato per indicare al browser che il file script può essere eseguito in modo asincrono. Cioè il parser HTML non deve necessariamente stopparsi quando incontra il tag script (in modo da caricacare, fetch, il file) ed eseguirlo. Infatti l'esecuzione dello script può avvenire in qualsiasi momento in cui lo script diventa pronto.  
![async](./img/Async-Execution.png)  
[async vs defer](https://bitsofco.de/async-vs-defer/)

## Funzioni per l'output
Per accedere ad un elemento HTML, si può utilizzare il metodo `document.getElementById(id)`. Per l'output invece si utilizza:
- `innerHTML=...`: proprietà per scrivere all'interno dell'elemento HTML selezionato con il metodo precedente;
- `document.write("...")`: utilizzata principalmente per test. Usare questa proprietà dopo che il documento HTML è stato completamente caricato, eliminerà tutto l'HTML esistente;
- `window.alert("...")`: alert box per visualizzare i dati;
- `console.log("...")`: utilizzata per debugging.

## RegExp
Una regular expression è una sequenza di caratteri che forma un pattern di ricerca, il quale può essere utilizzato per cercare e rimpiazzare del testo.  
Sintassi:
```
/pattern/modifiers
```
Spesso le regular expressions sono utilizzate con i metodi sulle stringhe `search()` e `replace()`.  

### Modifiers
| Modifier      | Descrizione   		   |
| ------------- |:------------------------:|
| i				| Ricerca case-insensitive | 
| g				| Ricerca globale(non si ferma al primo match) |
| m				| Ricerca multilinea 		|

### Patterns
Le **parentesi** sono utilizzate per trovare un range di caratteri:
| Expression    | Descrizione   		   |
| ------------- |:------------------------:|
| [abc]		| Trova qualsiasi carattere presente tra le parenti | 
| [0-9]		| Trova qualsiasi cifra presente tra le parenti |
| (x\|y) | Trova qualsiasi delle alternative separate da con \| |

I **metacaratteri** sono caratteri con un significato speciale:
| Metacarattere    | Descrizione   		   |
| ------------- |:------------------------:|
| \d		| Trova una cifra | 
| \s		| Trova un carattere bianco |
| \b | Trova un match all'inizio o alla fine della parola |
| \uxxxx | Trova il carattere Unicode specificato dal numero esadecimale xxxx |

I **quantificatori** definisco delle quantità:  
| Quantificatore    | Descrizione   		   |
| ------------- |:------------------------:|
| n+	| Trova qualsiasi stringa che contiene almeno un _n_ | 
| n*		| Trova qualsiasi stringa che contiene zero o più occorrenze di _n_ |
| n? | Trova qualsiasi stringa che contiene zero un'occorrenza di _n_ |

### L'oggetto RegExp
Inoltre in JavaScript esiste l'oggetto RegExp, cioè un regular expression object con proprietà e metodi definiti.

## Hoisting
In JavaScript una variabile può essere dichiarata dopo che questa è stata utilizzata. Questo comportameto è dovuto all'hoisting, cioè il comportamento di default di JavaScript di spostare tutte le dichiarazioni all'inizio dello scope corrente.  
È importante notare che solo le dichiarazioni sono soggette all'hoisting, mentre le inizializzazioni no.
Per evitare bug, dichiarare sempre tutte le variabili all'inizio di ogni scope.