<?php
include_once __DIR__ . '/../../config/database.php';

global $conn;
$id = $_GET['id'] ?? null;
if ($id) {
    $sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
    $result = mysqli_query($conn, $sql);
}
header('location: index.php?page=user/list');
