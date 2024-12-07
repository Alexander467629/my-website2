<?php 
require_once dirname(__DIR__) . '/pdo/db.php';

$users = getAll('users');
?>

<h2>All Users</h2>
<?php foreach($users as $user): ?>
<p>
  <a href="?app=users&view=show&id=<?= $user['id'] ?>">
    <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
  </a>
</p>
<?php endforeach; ?>
