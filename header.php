<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <header>
        <h1>Dashboard Admin</h1>
    </header>
    <nav>
        <a href="index.php">Dashboard</a>
        <a href="index.php?page=user/list">Data Barang</a>
        <a href="index.php?page=user/add">Tambah</a>
        <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
        <?php if (!empty($_SESSION['auth'])): ?>
            <a href="index.php?page=auth/logout">Logout (<?php echo htmlspecialchars($_SESSION['auth']['user'] ?? ''); ?>)</a>
        <?php else: ?>
            <a href="index.php?page=auth/login">Login</a>
        <?php endif; ?>
    </nav>
