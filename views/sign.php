<h1>
    <? if ($_GET['a'] == 'signUp'): ?>
        Регистрация
    <? elseif ($_GET['a'] == 'signIn'): ?>
        Вход
    <? endif; ?>
</h1>
<form method="post">
    <label>Логин: <input type="text" name="user[login]"></label>
    <br><br>
    <label>Пароль: <input type="password" name="user[password]"></label>
    <br><br>
    <input type="submit" value="Зарегистрироваться">
</form>