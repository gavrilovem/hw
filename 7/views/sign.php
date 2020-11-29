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
    <? if ($_GET['a'] == 'signUp'): ?>
        <input type="submit" value="Зарегистрироваться">
    <? elseif ($_GET['a'] == 'signIn'): ?>
        <input type="submit" value="Войти">
    <? endif; ?>
</form>