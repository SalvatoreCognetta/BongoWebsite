# Proprietà
- `array array_filter(array $arr)`: funzione che mantiene solo i valori che non sono nulli nell'array. [Stackoverflow](https://stackoverflow.com/questions/4422889/how-to-count-non-empty-entries-in-a-php-array) , [PHP Manual](http://www.php.net/manual/en/function.array-filter.php)
- `int count(array $arr)`: funzione che conta tutti gli elementi in un array, o in un oggetto. [PHP Manual](http://php.net/manual/en/function.count.php)  
- `string gettype(mixed $var)`: restituisce il tipo della variabile passata (come "boolean", "integer", "double", "string", "NULL", ecc.) [PHP Manual](http://php.net/manual/en/function.gettype.php)
- `bool mysqli_stmt::bind_param(string $types, mixed &$var1 [, mixed &$... ])`: associa le variabili var1, var2... ad un prepared statement come parametri; la variabile `$types` è una stringa che contiene uno o più caratteri che specificano il tipo per i corrispondenti parametri associati (i = integer, d = double, s = string, b = blob). [PHP Manual](http://php.net/manual/en/mysqli-stmt.bind-param.php)

# Database
## Connessione
- `new mysqli($servername, $username, $password, $dbname);`: utilizzata per la costruzione di una nuova connessione tra PHP e MYSQL database, restituisce un oggetto classe mysqli. [PHP Manual](http://php.net/manual/en/class.mysqli.php)

## Prepared statement
Un prepared statement è una caratteristica usa per eseguire statement SQL ripetutamente con alta efficienza. Sono moklto utili contro l'SQL Injections. Esso consiste in:
1. Prepare: viene creato un template di uno statement SQL e viene inviato al database; alcuni valori sono lasciati non specificati, chiamati parametri (etichettati come "?");
2. Il database analizza, compila ed esegue un ottimizzazione della query sul template SQL, e memorizza il risultato senza eseguirlo;
3. Execute: successivamente l'applicazione associerà i valori ai parametri("?") e il db eseguirà lo statement