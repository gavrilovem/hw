<?php /** @var array $users */ ?>
<h1>Все пользователи</h1>
<div>
    <? foreach ($users as $user): ?>
    <div>
        <p>Логин: <a href="/?c=user&a=one&id=<?=$user['id']?>"><?=$user['login']?></a></p>
    </div>
    <hr>
    <? endforeach; ?>
</div>