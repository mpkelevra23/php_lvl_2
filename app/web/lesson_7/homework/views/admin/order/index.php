<?php require_once ROOT . '/views/layouts/admin_header.php'; ?>

    <div class="content">
        <table>
            <thead>
            <tr>
                <td>Номер заказа</td>
                <td>Имя пользователя</td>
                <td>Почта пользователя</td>
                <td>Дата заказа</td>
                <td>Стоймость заказа</td>
                <td>Статус</td>
                <td>Редактировать</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orderList as $order): ?>
                <tr>
                    <td>
                        <?= $order['id'] ?>
                    </td>
                    <td>
                        <?= $order['user_name'] ?>
                    </td>
                    <td>
                        <?= $order['user_email'] ?>
                    </td>
                    <td>
                        <?= $order['created'] ?>
                    </td>
                    <td>
                        <?= $order['total_price'] ?>
                    </td>
                    <td>
                        <?= $order['status'] ?>
                    </td>
                    <td>
                        <a href="/admin/order/update/<?= $order['id'] ?>"> изменить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?php require_once ROOT . '/views/layouts/admin_footer.php'; ?>