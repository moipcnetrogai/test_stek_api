<?php
include_once "database.php";

$database = new Database();
$db = $database->getConnection(true);