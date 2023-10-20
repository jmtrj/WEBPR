<?php
session_start();
if (!isset($_SESSION['ADMIN']) || trim($_SESSION['ADMIN']) === '') {
    header('Location: ../../index.php');
}
require_once '../../db_con/conn.php';
require_once '../../crud/crud.php';

$sql = "SELECT * FROM tbluser WHERE Id = :id";
$id = $_SESSION['ADMIN'];
$result = $crud->read('tbluser', 'Id = :id', [
    ':id' => $id
]);
$result = $result[0];
?>