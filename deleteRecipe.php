<?php
session_start();
require_once('Connection.php');

$id = $_GET['id'];
$connection = Connection::getInstance();
if($id>0) {
    $query = $connection->delete($id);
    if ($query == true) {
        $_SESSION['success'] = 'Deleted!';
        Header('Location: index.php');
        exit;
    }
}