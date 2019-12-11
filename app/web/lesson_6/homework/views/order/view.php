<?php require_once ROOT . '/views/layouts/header.php'; ?>

    <div class="content">

        <h1>Номер заказа:
            <b><?= $orderId; ?></b> от <?= $created; ?>
        </h1>

        <div>
            <table>
                <thead>
                <tr>
                    <td>Товар</td>
                    <td>Цена</td>
                    <td>Статус</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>
                            <?= $order['good_name'] ?>
                        </td>
                        <td>
                            <?= $order['price'] ?>
                        </td>
                        <td>
                            <?= $order['status'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>