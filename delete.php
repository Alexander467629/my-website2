<?php 
session_start();
require_once dirname(__DIR__) . '/pdo/db.php';

// Генерация токена, если его еще нет
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = getById('users', $id);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (hash_equals($_SESSION['token'], $_POST['token'])) {
                delete('users', $id);
                header('Location: ?app=users&view=list');
                exit();
            } else {
                echo 'Invalid token';
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID provided.";
}

if ($user) {
?>
<h2>Delete User</h2>
<p>Are you sure you want to delete the following user?</p>
<ul>
    <li>Username: <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></li>
    <li>Age: <?= htmlspecialchars($user['age'], ENT_QUOTES, 'UTF-8') ?></li>
</ul>

<form method="POST">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <button type="submit">Confirm Delete</button>
    <a href="?app=users&view=list">Cancel</a>
</form>
<?php
}
?>
