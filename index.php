<?php
/**
 * Handles requests to database
 */

header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "DbManager.php";

$dbManager = new DbManager();

$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "POST":
        $dbManager->addProduct();
        break;
    case "GET":
        $dbManager->getProducts();
        break;
    case "DELETE":
        $dbManager->deleteProduct();
        break;
}