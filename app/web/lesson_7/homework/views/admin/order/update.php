<?php require_once ROOT . '/views/layouts/header.php'; ?>

    <div class="content">

        <p>Номер заказа:<b> <?= $order['id']; ?></b> от <b><?= $order['created']; ?></b></p>
        <p>Статус заказа: <b><?= $order['status']; ?></b></p>
        <form action="#" method="post" id="order">
            <label for="order">
                <select name="status" required>
                    <?php foreach ($orderStatus as $status): ?>
                        <?php if ($status['id'] === $order['status_id']) : ?>
                            <option selected value="<?= $status['id']; ?>"><?= $status['name']; ?></option>
                        <?php else : ?>
                            <option value="<?= $status['id']; ?>"><?= $status['name']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </label>
            <p><input type="submit" name="submit" value="Сохранить"/></p>
        </form>
    </div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>