<?php /** @var array $good @var array $comments */ ?>
<div>
    <p><?= $good['name'] ?></p>
    <p>Цена: <?= $good['price'] ?></p>
</div>

<h2>Комментарии</h2>

<? if (isset($_SESSION['user'])): ?>
    <form action="/?c=good&a=createComment" method="post">
        <input type="text" name="value">
        <input type="submit" value="Отправить комментарий">
    </form>
<? else: ?>
    <p>Войдите, чтобы оставить комментарий</p>
<? endif; ?>

<div>
    <? if ($comments):
        foreach ($comments as $comment): ?>
            <div>
                <h2><?= $comment['user_login'] ?></h2>
                <p><?= $comment['comment'] ?></p>
                <p>Дата добавления: <?= $comment['created_at'] ?></p>
            </div>
        <? endforeach;
    else: ?>
        <br>
        Нет комментариев
    <? endif; ?>
</div>