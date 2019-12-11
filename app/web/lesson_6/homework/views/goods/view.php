<?php require_once ROOT . '/views/layouts/header.php'; ?>

    <h1><?= $goods['name'] ?></h1>

    <div class="content">
        <details open><summary>Подробнее</summary><?= $goods['description'] ?></details>
        <p><?= $goods['price'] ?> &#x20bd;</p>

        <?php if (!User::isGuest()): ?>
            <p><a href="/basket/add/<?= $goods['id']; ?>">
                    <button>Добавить</button>
                </a></p>
        <?php endif; ?>
    </div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>