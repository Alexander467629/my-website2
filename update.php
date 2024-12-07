<?php 
session_start();
require_once dirname(__DIR__) . '/pdo/db.php';

// Генерация токена, если его еще нет
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$user = getById('users', $_GET['id']);

if (!empty($_POST)) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userId = $_GET['id'];
        $age = $_POST['age'];
        update('users', [
            'id' => $_GET['id'],
            'username' => $username,
            'password' => $password,
            'age' => $age,
            'updated_at' => (new DateTime())->format('Y-m-d H:i:s')
        ]);
        header("Location: ?app=users&view=show&id=$userId");
        exit();
    } else {
        echo 'Invalid token';
    }
}
?>

<h2>Update User</h2>

<form action="" method="post" class="form">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <div class="form__field">
        <label for="username" class="form__label">Username:</label>
        <input type="text" id="username" name="username" class="form__input" value="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');?>" required>
    </div>
    <div class="form__field">
        <label for="password" class="form__label">Password:</label>
        <input type="password" id="password" name="password" class="form__input" value="<?= htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8');?>" required>
    </div>
    <div class="form__field">
        <label for="age" class="form__label">Age:</label>
        <input type="number" id="age" name="age" class="form__input" value="<?= htmlspecialchars($user['age'], ENT_QUOTES, 'UTF-8');?>" required>
    </div>
    <button type="submit">Send</button>
</form>
