<?php

header("Content-Type: application/json");
// stops.php
include_once '../config/database.php';
include_once '../models/Stage.php';

$stop = new Stage($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['trip_id']) && isset($_GET['day_id']) && isset($_GET['stage_number'])) {
                // Ottieni una tappa specifica basata su trip_id, day_id e stage_number
                $result = $stage->getStageByNumber($_GET['trip_id'], $_GET['day_id'], $_GET['stage_number']);
                echo json_encode($result);
            } else {
                // Altri metodi GET possono essere gestiti qui
            }
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stop->day_id = $data['day_id'];
        $stop->title = $data['title'];
        $stop->stage_number = $data['stage_number'];
        $stop->description = $data['description'];
        $stop->location = $data['location'];
        $stop->image = $data['image'];
        if ($stop->create()) {
            echo json_encode(['success' => true, 'stop_id' => $stop->id]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stop->id = $data['id'];
        $stop->day_id = $data['day_id'];
        $stop->title = $data['title'];
        $stop->stage_number = $data['stage_number'];
        $stop->description = $data['description'];
        $stop->location = $data['location'];
        $stop->image = $data['image'];
        if ($stop->update()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stop->id = $_GET['id'];
            if ($stop->delete()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;
}
