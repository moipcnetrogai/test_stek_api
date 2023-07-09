<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/book.php";

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

$book->id = $data->id;

$book->name = $data->name;
$book->year = $data->year;
$book->author = $data->author;

if ($book->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Книга была обновлена"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить книгу"), JSON_UNESCAPED_UNICODE);
}