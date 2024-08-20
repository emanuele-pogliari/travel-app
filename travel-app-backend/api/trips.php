<?php

header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../models/Trip.php';

// Assicurati che $db non sia null
if ($db === null) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Crea l'oggetto Trip
$trip = new Trip($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $trip->getById($_GET['id']);
        } else {
            $result = $trip->getAll();
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $trip->title = $data['title'];
        $trip->description = $data['description'];
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
