<?php require_once ROOT . '/views/layouts/header.php'; ?>

<div class="content">
    <p>Ваше имя: <?= $user['name'] ?></p>
    <p>Ваша почта: <?= $user['email'] ?></p>
    <p><a href="/order/list">Мои заказы</a></p>

    <h3>Последние посещённый страницы</h3>
    <?php foreach ($last_actions as $last_action): ?>
        <p><?= $last_action; ?></p>
    <?php endforeach; ?>
</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
