<?php
// Front controller + routing
$base = __DIR__;
require_once $base . '/config/database.php';
if (session_status() === PHP_SESSION_NONE) session_start();

include $base . '/views/header.php';

$page = isset($_GET['page']) ? trim($_GET['page']) : '';
// Default: kalau belum login tampilkan login, kalau sudah login tampilkan dashboard
$view = empty($_SESSION['auth'])
    ? ($base . '/modules/auth/login.php')
    : ($base . '/views/dashboard.php');

if ($page !== '') {
    $clean = str_replace(['..', '\\'], '', $page);
    $candidate = $base . '/modules/' . $clean . '.php';
    // Require login for user/* pages
    if (str_starts_with($clean, 'user/') && empty($_SESSION['auth'])) {
        $candidate = $base . '/modules/auth/login.php';
    }
    if (is_file($candidate)) {
        $view = $candidate;
    } else {
        http_response_code(404);
        echo '<main><h2>404 - Halaman tidak ditemukan</h2></main>';
        $view = null;
    }
}

if ($view) include $view;

include $base . '/views/footer.php';
