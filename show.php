<?php 
session_start();
require_once dirname(__DIR__) . '/pdo/db.php';

// Генерация токена, если его еще нет
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$user = getById('users', $_GET['id']);
?>
<h2>User Details</h2>
<table class="table">
  <tr class="table__row">
    <td class="table__cell">Username</td>
    <td class="table__cell">Age</td>
    <td class="table__cell">Password</td>
  </tr>
  <tr class="table__row">
    <td class="table__cell"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
    <td class="table__cell"><?= htmlspecialchars($user['age'], ENT_QUOTES, 'UTF-8') ?></td>
    <td class="table__cell"><?= htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8') ?></td>
  </tr>
</table>
<a href="?app=users&view=update&id=<?= $user['id'] ?>">Update</a>
<form action="?app=users&view=delete&id=<?= $user['id'] ?>" method="POST" style="display: inline;">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <button type="submit">Delete</button>
</form>
