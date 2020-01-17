<?php require_once ROOT . '/views/layouts/header.php'; ?>

<div class="content">

    <h2>Вход</h2>
    <?php if (isset($errors['userId'])): ?>
        <p><?= $errors['userId']; ?></p>
    <?php endif; ?>
    <form action="#" method="post">
        <?php if (isset($errors['email'])): ?>
            <p><?= $errors['email']; ?></p>
        <?php endif; ?>
        <p><input type="email" name="email" placeholder="E-mail" value="<?= $email; ?>"/></p>
        <?php if (isset($errors['password'])): ?>
            <p><?= $errors['password']; ?></p>
        <?php endif; ?>
        <p><input type="password" name="password" placeholder="Пароль"
                  value="<?= $password; ?>"/></p>
        <p><input type="submit" name="submit" value="Войти"/></p>
    </form>

</div>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>
