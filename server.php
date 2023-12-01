<?php 

//leggo il json e lo attribuisco ad una stringa
$dbContent = file_get_contents("todo-list.json");

//controllo che venga recepito
//var_dump($dbContent);

//trasformo la stringa in un array php
$serverList = json_decode($dbContent, true);

if(isset($_POST['addATask'])) {
    $newTask = [
        "task" => $_POST['addATask'],
        "done"=> false
    ];
    array_push($serverList, $newTask);
    file_put_contents("todo-list.json", json_encode($serverList));
};


if(isset($_POST['killTheTask'])) {
    $taskIndex = $_POST['killTheTask'];
    array_splice($serverList,$taskIndex,1);
    file_put_contents("todo-list.json", json_encode($serverList));
};







//ricevi un contenuto json
header("Content-Type: application/json");

//specifico il contenuto json da accogliere
echo json_encode($serverList);
