<?php 
session_start();
require_once dirname(__DIR__) . '/pdo/db.php';

// Генерация токена, если его еще нет
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (!empty($_POST)) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $id = create('users', [
            'username' => $username,
            'password' => $password,
            'age' => $age
        ]);
        if ($id) {
            header('Location: ?app=users&view=list'); // Перенаправление на страницу списка пользователей
            exit();
        } else {
            echo 'Error'; // Перенаправить на страницу ошибки
        }
    } else {
        echo 'Invalid token';
    }
}
?>

<h2>Create User</h2>

<form action="" class="form" method="post">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <div class="form__field">
        <label for="username" class="form__label">Username:</label>
        <input type="text" id="username" name="username" class="form__input" required>
    </div>
    <div class="form__field">
        <label for="password" class="form__label">Password:</label>
        <input type="password" id="password" name="password" class="form__input" required>
    </div>
    <div class="form__field">
        <label for="age" class="form__label">Age:</label>
        <input type="number" id="age" name="age" class="form__input" required>
    </div>
    <button type="submit">Send</button>
</form>
