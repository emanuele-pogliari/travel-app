<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/Trip.php';

if ($db === null) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$trip = new Trip($db);

$data = json_decode(file_get_contents('php://input'), true);

// Logga il contenuto grezzo
error_log('Raw data received: ' . file_get_contents('php://input'));

// Logga il JSON decodificato
error_log('Decoded data: ' . print_r($data, true));

// if (!$data) {
//     echo json_encode(['success' => false, 'message' => 'Dati non ricevuti o JSON malformato']);
//     exit;
// }

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id']) && isset($_GET['day']) && isset($_GET['stage'])) {
            $result = $trip->getStageByTripIdDayNumberAndStageNumber($_GET['id'], $_GET['day'], $_GET['stage']);
        } elseif (isset($_GET['id']) && isset($_GET['day'])) {
            $result = $trip->getDayByTripId($_GET['id'], $_GET['day']);
        } elseif (isset($_GET['id'])) {
            $result = $trip->getById($_GET['id']);
        } else {
            $result = $trip->getAll();
        }
        echo json_encode($result);
        break;

    case 'POST':
        if (!isset($data['title'], $data['description'], $data['start_date'], $data['cover'], $data['number_of_days'])) {
            echo json_encode(['success' => false, 'message' => 'Campi mancanti']);
            exit;
        }

        // Set the properties of the Trip object
        $trip->title = $data['title'];
        $trip->description = $data['description'];
        $trip->start_date = $data['start_date'];
        $trip->cover = $data['cover'];
        $trip->number_of_days = $data['number_of_days'];

        // Create the trip and associated days
        if ($trip->createWithDays()) {  // Note: Assuming we have this method in the Trip class
            echo json_encode(['success' => true, 'trip_id' => $trip->id]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;
        // Gestisci l'upload del file e il salvataggio dei dati
        $data = [];

        // Verifica se il file immagine è stato caricato
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['cover']['tmp_name'];
            $fileName = $_FILES['cover']['name'];
            $fileSize = $_FILES['cover']['size'];
            $fileType = $_FILES['cover']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Definisci il percorso di destinazione per salvare l'immagine
            $upload_dir = dirname(__DIR__, 2) . '/uploads/';
            $upload_file = $upload_dir . basename($fileName);

            // Controlla se la cartella di upload esiste e crea se non esiste
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Controlla se il file è stato caricato correttamente
            if (move_uploaded_file($fileTmpPath, $upload_file)) {
                $data['cover'] = $fileName; // Salva il nome del file per il salvataggio nel database
            } else {
                error_log('Failed to move uploaded file from ' . $fileTmpPath . ' to ' . $upload_file);
                echo json_encode(['success' => false, 'message' => 'Failed to upload file.']);
                exit;
            }
        } else {
            // Se il file non è presente, impostare $data['cover'] su null
            $data['cover'] = null;
        }

        // Verifica che tutti i campi richiesti siano presenti
        if (!isset($_POST['title'], $_POST['description'], $_POST['start_date'])) {
            echo json_encode(['success' => false, 'message' => 'Campi mancanti']);
            exit;
        }

        // Assegna i dati al modello
        $trip->title = $_POST['title'];
        $trip->description = $_POST['description'];
        $trip->cover = $data['cover']; // Usa il nome del file caricato o null
        $trip->start_date = $_POST['start_date'];

        // Crea il viaggio
        if ($trip->create()) {
            echo json_encode(['success' => true, 'trip_id' => $trip->id]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;



    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $trip->id = $data['id'];
        $trip->title = $data['title'];
        $trip->description = $data['description'];
        $trip->cover = $data['cover'];
        $trip->start_date = $data['start_date'];
        if ($trip->update()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $trip->id = $_GET['id'];
            if ($trip->delete()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;
}
