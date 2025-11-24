<?php
// Simple session-based login (demo)
if (session_status() === PHP_SESSION_NONE) session_start();
if (!empty($_SESSION['auth'])) { header('Location: index.php'); exit; }

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Demo credential; ganti dengan tabel user jika tersedia
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['auth'] = [ 'user' => $username, 'time' => time() ];
        header('Location: index.php?page=user/list');
        exit;
    } else {
        $err = 'Username atau password salah';
    }
}
?>
<main class="auth">
    <h2>Login</h2>
    <?php if (!empty($err)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
    <?php endif; ?>
    <form method="post" action="index.php?page=auth/login">
        <div class="input">
            <label>Username</label>
            <input type="text" name="username" required />
        </div>
        <div class="input">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <div class="submit">
            <button type="submit" class="btn btn-brand btn-lg">Masuk</button>
        </div>
    </form>
</main>
