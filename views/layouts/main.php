<?php
/** @var string $content */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<ul>
    <li><a href="/">Главная</a></li>
    <? if ($_SESSION['user']['is_admin'] == '1'): ?>
        <li><a href="/?c=user&a=all">Все пользователи</a></li>
    <? endif; ?>
    <li><a href="/?c=good&a=all">Товары</a></li>
    <? if (isset($_SESSION['user'])): ?>
        <li><a href="/?c=user&a=signOut">Выйти</a></li>
    <? else: ?>
        <li><a href="/?c=user&a=signIn">Войти</a> | <a href="/?c=user&a=signUp">Зарегистрироваться</a></li>
    <? endif; ?>
</ul>
<?= $content ?>
</body>
</html>