<?php /** @var array $good @var array $comments */ ?>
<div>
    <div style="width: 130px">
        <img src="img/<?= $good['photo_name'] ?>" alt="not-found" width="100%">
    </div>
    <div>
        <p><?= $good['name'] ?></p>
        <p>Цена: <?= $good['price'] ?></p>
    </div>
</div>

<h2>Комментарии</h2>

<? if (isset($_SESSION['user'])): ?>
    <form action="/?c=good&a=createComment" method="post">
        <input type="text" value="<?= $good['id'] ?>" name="id" hidden>
        <input type="text" name="value" required>
        <input type="submit" value="Отправить комментарий">
    </form>
<? else: ?>
    <p>Войдите, чтобы оставить комментарий</p>
<? endif; ?>

<div>
    <? if ($comments):
        foreach ($comments as $comment): ?>
            <hr>
            <div>
                <h2><?= $comment['user_login'] ?></h2>
                <p><?= $comment['comment'] ?></p>
                <p>Дата добавления: <?= $comment['created_at'] ?></p>
            </div>
        <? endforeach; ?>
        <hr>
    <? else: ?>
        <br>
        Нет комментариев
    <? endif; ?>
</div>