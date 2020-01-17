<?php require_once ROOT . '/views/layouts/header.php'; ?>

<h1>Корзина</h1>

<div class="content">
    <table>
        <thead>
        <tr>
            <td>Наименование</td>
            <td>Цена</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($goods as $product): ?>
            <tr>
                <td>
                    <?= $product['name'] ?>
                </td>
                <td>
                    <?= $product['price'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td>Общая сумма</td>
            <td><?= $totalPrice['sum']; ?></td>
        </tr>
        </tfoot>
    </table>
    <p><a href="/order/create">
            <button>Оформить заказ</button>
        </a></p>
</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
