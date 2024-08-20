<?php

include_once '../config/db.php';
include_once '../models/Stage.php';

$stop = new Stage($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['day_id'])) {
            $result = $stage->getByDayId($_GET['day_id']);
        } elseif (isset($_GET['id'])) {
            $result = $stage->getById($_GET['id']);
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stage->day_id = $data['day_id'];
        $stage->title = $data['title'];
        $stage->description = $data['description'];
        $stage->location = $data['location'];
        $stage->image = $data['image'];
        if ($stage->create()) {
            echo json_encode(['success' => true, 'stop_id' => $stage->id]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stage->id = $data['id'];
        $stage->day_id = $data['day_id'];
        $stage->title = $data['title'];
        $stage->description = $data['description'];
        $stage->location = $data['location'];
        $stage->image = $data['image'];
        if ($stage->update()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stage->id = $_GET['id'];
            if ($stage->delete()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        break;
}
