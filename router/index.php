<?php

use Controller\ItemController;
use Controller\CabinetController;

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('?', $uri)[0];

$request_method = $_SERVER['REQUEST_METHOD'];

$cabinetController = new CabinetController();
$itemController = new ItemController();

if ($uri === '/' && $uri === '') {
  http_response_code(404);
  echo 'Seite nicht gefunden';
  return;
} elseif ($uri === '/cabinet/all' && $request_method === 'GET') {
  echo json_encode($cabinetController->getAllCabinets());
  return;
} elseif ($uri === '/cabinet' && $request_method === 'GET') {
  $id = intval($_GET['id']);
  if(!is_int($id)){
    http_response_code(403);
    echo 'Bitte eine gültige ID angeben';
    return;
  }
  echo json_encode($cabinetController->getCabinet($id));
  return;
} elseif ($uri === '/item/all' && $request_method === 'GET') {
  echo json_encode($itemController->getAllItems());
  return;
} elseif ($uri === '/item' && $request_method === 'GET') {
  $id = intval($_GET['id']);
  if(!is_int($id)){
    http_response_code(403);
    echo 'Bitte eine gültige ID angeben';
    return;
  }
  echo json_encode($itemController->getItem($id));
  return;
} else {
  http_response_code(404);
  echo 'Seite nicht gefunden';
  return;
}