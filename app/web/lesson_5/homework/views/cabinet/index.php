<?php require_once ROOT . '/views/layouts/header.php'; ?>

<p>Ваше имя: <?= $user['name'] ?></p>
<p>Ваша почта: <?= $user['email'] ?></p>

<h3>Последние посещённый страницы</h3>
<?php foreach ($last_actions as $last_action): ?>
    <p><?= $last_action; ?></p>
<?php endforeach; ?>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
