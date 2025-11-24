<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "lab9_php_modular";

// Matikan exception agar tidak fatal ketika gagal konek
if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

$conn = @mysqli_connect($host, $user, $pass, $db);
if ($conn == false) {
    // Pesan singkat di UI dan detail ke log
    echo '<div style="background:#fde68a;padding:10px;border-radius:6px;margin:10px 0">Tidak dapat terhubung ke database. Pastikan MySQL berjalan dan database "'.htmlspecialchars($db).'" tersedia.</div>';
    error_log("Koneksi ke server MySQL gagal: ".mysqli_connect_error());
}
function db_conn(){
    global $conn; return $conn;
}
