<?php 

//leggo il json e lo attribuisco ad una stringa
$dbContent = file_get_contents("todo-list.json");

//controllo che venga recepito
//var_dump($dbContent);

//trasformo la stringa in un array php
$serverList = json_decode($dbContent, true);










//ricevi un contenuto json
header("Content-Type: application/json");

//specifico il contenuto json da accogliere
echo json_encode($serverList);
