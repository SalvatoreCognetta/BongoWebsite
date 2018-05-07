# Proprietà
- `array array_filter(array $arr)`: funzione che mantiene solo i valori che non sono nulli nell'array. [Stackoverflow](https://stackoverflow.com/questions/4422889/how-to-count-non-empty-entries-in-a-php-array) , [PHP Manual](http://www.php.net/manual/en/function.array-filter.php)
- `int count(array $arr)`: funzione che conta tutti gli elementi in un array, o in un oggetto. [PHP Manual](http://php.net/manual/en/function.count.php)  
- `string gettype(mixed $var)`: restituisce il tipo della variabile passata (come "boolean", "integer", "double", "string", "NULL", ecc.) [PHP Manual](http://php.net/manual/en/function.gettype.php)

- `bool mysqli_stmt::bind_param(string $types, mixed &$var1 [, mixed &$... ])`: associa le variabili var1, var2... ad un prepared statement come parametri; la variabile `$types` è una stringa che contiene uno o più caratteri che specificano il tipo per i corrispondenti parametri associati (i = integer, d = double, s = string, b = blob). [PHP Manual](http://php.net/manual/en/mysqli-stmt.bind-param.php)

## Superglobals
Le variabili superglobali sono variabili che sono sempre disponibili in tutti gli scopes.
- `$GLOBALS`: un array associativo contenente i riferimenti a tutte le varibili che sono attualmente definite nello scope globale dello script.
- `$_SERVER`: è un array contenente informazioni come headers, paths e locations dello script. Le entrate in questo array sono crete dal web server.
- `$_GET`: array associativo delle varibaili passate allo script corrente tramite parametri URL.
- `$_POST`: array associativo delle variabili passate allo script corrente tramite il metodo HTTP POST .
- `$_FILES`: array associativo di oggetti caricati nello script corrente tramite metodo HTTP POST.
- `$_COOKIE`: array associativo di variabili passati allo script corrente tramite HHTP Cookies.
- `$_SESSION`: array associativo contenente le variabili della sessione disponibili allo script corrente.
- `$_REQUEST`: un array associativo che contiene i contenuti di `$_GET`, `$_POST` e `$_COOKIE`.

# Database
## Connessione
- `new mysqli($servername, $username, $password, $dbname);`: utilizzata per la costruzione di una nuova connessione tra PHP e MYSQL database, restituisce un oggetto classe mysqli. [PHP Manual](http://php.net/manual/en/class.mysqli.php)

## Prepared statement
Un prepared statement è una caratteristica usa per eseguire statement SQL ripetutamente con alta efficienza. Sono moklto utili contro l'SQL Injections. Esso consiste in:
1. Prepare: viene creato un template di uno statement SQL e viene inviato al database; alcuni valori sono lasciati non specificati, chiamati parametri (etichettati come "?");
2. Il database analizza, compila ed esegue un ottimizzazione della query sul template SQL, e memorizza il risultato senza eseguirlo;
3. Execute: successivamente l'applicazione associerà i valori ai parametri("?") e il db eseguirà lo statement

## Rischio di un image upload
[StackOverflow](https://security.stackexchange.com/questions/32852/risks-of-a-php-image-upload-form)