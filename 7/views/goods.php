<?php /** @var array $goods */ ?>
<? if ($_SESSION['user']['is_admin'] == '1'): ?>
<div><a href="/?c=good&a=create">Создать товар</a></div>
<? endif; ?>
<div>
    <? foreach ($goods as $good): ?>
    <div style="display: flex; justify-content: space-between; width: 300px">
        <div style="width: 45%">
            <a href="/?c=good&a=one&id=<?= $good['id'] ?>">
                <img src="img/<?= $good['photo_name'] ?>" alt="not-found" width="100%">
            </a>
        </div>
        <div style="width: 50%">
            <p><a href="/?c=good&a=one&id=<?= $good['id'] ?>"><?= $good['name'] ?></a></p>
            <p>Цена: <?= $good['price'] ?></p>
            <? if($_SESSION['user']['is_admin'] == '1'): ?>
                <a href="?c=good&a=delete&id=<?= $good['id'] ?>">Удалить</a>
                <a href="?c=good&a=create&id=<?= $good['id'] ?>">Редактировать</a>
            <? endif; ?>
        </div>
    </div>
        <hr>
    <? endforeach; ?>
</div>