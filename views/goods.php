<?php /** @var array $goods */ ?>
<div><a href="/?c=good&a=create">Создать товар</a></div>
<div>
    <? foreach ($goods as $good): ?>
        <div>
            <p><a href="/?c=good&a=one&id=<?= $good['id'] ?>"><?= $good['name'] ?></a></p>
            <p>Цена: <?= $good['price'] ?></p>
            <a href="?c=good&a=delete&id=<?= $good['id'] ?>">Удалить</a>
            <a href="?c=good&a=create&id=<?= $good['id'] ?>">Редактировать</a>
        </div>
        <hr>
    <? endforeach; ?>
</div>