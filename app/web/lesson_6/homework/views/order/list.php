<?php require_once ROOT . '/views/layouts/header.php'; ?>

<div class="content">

    <?php foreach ($orders as $order): ?>
        <p>
            <a href="/order/view/<?= $order['id']; ?>">Заказ <b><?= $order['id']; ?></b> от
                <i><?= $order['created']; ?></i></a>
        </p>
    <?php endforeach; ?>

</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
