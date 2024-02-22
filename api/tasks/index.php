<?php
header('Content-Type: application/json');

// Percorso del file JSON
$tasksFilePath = '../../tasks/tasks.json';

// Gestione delle richieste
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Leggi i compiti dal file JSON e restituisci come risposta JSON
    $tasks = json_decode(file_get_contents($tasksFilePath), true);
    echo json_encode($tasks);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aggiungi un nuovo compito al file JSON
    $data = json_decode(file_get_contents('php://input'), true);

    $tasks = json_decode(file_get_contents($tasksFilePath), true);
    $newTask = [
        'id' => count($tasks) + 1,
        'text' => $data['text'],
        'done' => false
    ];
    $tasks[] = $newTask;

    file_put_contents($tasksFilePath, json_encode($tasks));

    echo json_encode(['message' => 'Task added successfully']);
} else {
    
    // Metodo non consentito
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

?>