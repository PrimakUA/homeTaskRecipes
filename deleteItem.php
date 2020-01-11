<?php
session_start();
require_once('Connection.php');

$id = $_GET['id'];
$table = $_GET['table'];
$place = $_GET['place'];
$connection = Connection::getInstance();
if($id>0) {
    $query = $connection->delete($table, $id);
    if ($query == true) {
        $_SESSION['success'] = 'Deleted!';
        Header("Location: " . $place . ".php");
        exit;
    }
}