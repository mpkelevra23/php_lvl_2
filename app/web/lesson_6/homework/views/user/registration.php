<?php require_once ROOT . '/views/layouts/header.php'; ?>

<h2>Регистрация на сайте</h2>
<form action="#" method="post">
    <?php if (isset($errors['name'])): ?>
        <p><?= $errors['name']; ?></p>
    <?php endif; ?>
    <p><input type="text" name="name" placeholder="Имя" value="<?= $name; ?>"/></p>
    <?php if (isset($errors['email'])): ?>
        <p><?= $errors['email']; ?></p>
    <?php endif; ?>
    <p><input type="text" name="email" placeholder="Email" value="<?= $email; ?>"/></p>
    <?php if (isset($errors['password'])): ?>
        <p><?= $errors['password']; ?></p>
    <?php endif; ?>
    <p><input type="password" name="password" placeholder="Пароль"
              value="<?= $password; ?>"/></p>
    <p><input type="submit" name="submit" value="Регистрация"/></p>
</form>

<?php require_once ROOT . '/views/layouts/footer.php'; ?>

