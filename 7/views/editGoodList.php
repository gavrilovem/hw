<?php /** @var array $good
        * @var array $categories
        */ ?>

<div>
    <form method="post" enctype="multipart/form-data">
        <? if (!empty($good)): ?>
            <h2>Редактировать</h2>
            <input hidden type="text" name="good[id]" value="<?= $good['id'] ?>">
        <? else: ?>
            <h2>Создать</h2>
        <? endif; ?>
        <label>Название
            <input type="text" name="good[name]" value="<?= $good['name'] ?>" placeholder="name" required autofocus>
        </label>
        <br><br>
        <label>Цена
            <input type="number" step="any" name="good[price]" value="<?= $good['price'] ?>" placeholder="price" required>
        </label>
        <br><br>
        <label>Категория
            <select name="good[category_id]">
                <? foreach ($categories as $category) :?>
                    <option value="<?=$category['id']?>"><?=ucfirst($category['name'])?></option>
                <? endforeach; ?>
            </select>
        </label>
        <br><br>
        <label>Фото
            <input type="file" name="good[file]" value="<?= dirname(__DIR__) . '/public/img/' . $good['photo_name'] ?>">
        </label>
        <br><br>
        <? if (!empty($good)): ?>
            <img src="img/<?=$good['photo_name']?>" alt="not-found" width="250px">
            <br><br>
        <? endif; ?>
        <input type="submit" value="Submit">
    </form>
</div>