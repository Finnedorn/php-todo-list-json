<?php 
//come passiamo i nostri dati da php a js ?
//in questa occasione useremo i file json come ponte d'incontro
//js-->server.php---->json--->js
//instaurando un ciclo di prelievo di dati dal json e reinvio 
//che renderà server.php una specie di API

//A) prendo il json "to-do-list" e lo trasformo in un array associativo in php
//in questo modo potrò usare server.php per gestire le chiamate axios 
//e alterare il file json comunicante a sua volta con js

// creo una var
//attraverso la funzione file_get_contents(nomefile.json)
//leggo il json e lo attribuisco ad una stringa
$dbContent = file_get_contents("todo-list.json");


//controllo che venga recepito
//var_dump($dbContent);

//creo una var
//attraverso la funzione json_decode(nomevardeljson, true)
//nota: il secondo parametro (true) comunica alla funzione di trasformare la strionga in array associativo
//trasformo la stringa in un array php
$serverList = json_decode($dbContent, true);


//funzione in js taskAdder
//una volta ricevuti i dati dalla funzione tramite chiamata axios.post
if(isset($_POST['addATask'])) {
    //creo una nuova variabile elemento array associativo
    //che ha come contenuto due key 
    //è strutturata priprio come uno degli elementi presenti nel json 
    //attribuisco alla key della task il contenuto della nuova task
    $newTask = [
        "task" => $_POST['addATask'],
        "done"=> false
    ];
    //dopodichè tramite la funzione array_push(nomedell'array, dell'elementodaaggiungere)
    //pusho questo nuovo elemento nell'array php preso dal json
    array_push($serverList, $newTask);
    //e lo invio al json
    //la funzione file_puts_contents("nome file",nome var con il testo da inserire)
    //mi permette di scrivere dei dati all'interno di un file
    //purchè questi siano scritti coerentemente a seconda del file 
    //è qua che interviene json_encode
    file_put_contents("todo-list.json", json_encode($serverList));
};

//funzione taskDeleter:
if(isset($_POST['killTheTask'])) {
    // creo una nuova variabile che accolga l'indice della task che dovrò rimuovere
    $taskIndex = $_POST['killTheTask'];
    //attraverso la funzione array_splice(nomearray,numeroelementodacuitogliereelementi, numerielementidatogliere)
    //rimuovo l'elemento dall'array
    array_splice($serverList,$taskIndex,1);
    //anche qua invio tutto al json
    file_put_contents("todo-list.json", json_encode($serverList));
};

// funzione doneMarker:
if(isset($_POST['markTheTask'])) {
    //creo una variabile che accolga l'indice della task che dovrò markare
    $taskmarker = $_POST['markTheTask'];
    //se la task che marchio è ha la key done === false allora passa a true 
    //e viceversa 
    //nota: su index.php le task hanno una classe v-bind
    //che se done === true le marchierà oppure no
    if($serverList[$taskmarker]['done'] === false) {
        $serverList[$taskmarker]['done'] = true;
    } else {
        $serverList[$taskmarker]['done'] = false;
    };
    //anche qua invio tutto al json
    file_put_contents("todo-list.json", json_encode($serverList));
};




//B) rispedisco le nuove info dall'array php $serverlist (un tempo file json) al "to-do-list.json" originale
//in questo modo instaurerò un ciclo che mi trae info dal json, me le traduce in array php
//e me le rimanda aggiornate al json di partenza!


//specifico il content della response
//questa dicitura è fissa (nel caso di file json)
header("Content-Type: application/json");

//stampo la lista in json aggiornandolo
//attraverso la funzione json_encode(nomeDellaVarCheContieneArray)
echo json_encode($serverList);
