<?php require_once ROOT . '/views/layouts/header.php'; ?>

<h1>Главная страница сайта</h1>

<div class="content">
    <?php foreach ($goods as $product): ?>
        <div>
            <a href="goods/view/<?= $product['id']; ?>"><p><?= $product['name']; ?></p></a>
            <p><?= $product['price']; ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>