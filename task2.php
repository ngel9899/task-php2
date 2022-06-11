<?php
// 1. Сделайте счетчик обновления страницы пользователем. Данные храните в сессии.
// Скрипт должен выводить на экран количество обновлений.
// При первом заходе на страницу он должен вывести сообщение о том, что вы еще не обновляли страницу.


session_start();

if (!isset($_COOKIE['examination'])) {
    setcookie('value' , '1', time() + 10);
    setcookie('examination' , '0', time() + 60);
    $NumberOfUpdates = "Вы не обновляли страницу";
  } else {
    $_COOKIE['value'] += 1;
    setcookie('value' , $_COOKIE['value']);
    $NumberOfUpdates = "Вы обновляли страницу {$_COOKIE['value']}  раз";
  }


echo "<p>$NumberOfUpdates</p>";


// 2. Спросите у пользователя email с помощью формы.
// Затем сделайте так, чтобы в другой форме (поля: имя, фамилия, пароль, email)
// при ее открытии поле email было автоматически заполнено.
session_start();
if (!isset($_COOKIE['mail'])) {
    setcookie('mail' , $_POST['email'], time() + 60);
    $mail = $_COOKIE['mail'];
} else {
    $mail = $_COOKIE['mail'];
  }
?>

<form action="" method="post">
  <p>Укажите вашу электронную почту</p>
  <p>Электронная почта: <input type="text" name="email"></p>
  <p><input type="submit" name="submit" value="push"></p>
</form>

<form action="" method="post">
  <p>Имя: <input type="text" name="username"></p>
  <p>Фамилия: <input type="text" name="username"></p>
  <p>Пароль: <input type="password" name="userpass"></p>
  <p>Электронная почта: <input type="text" name="userpass" value="<?=$mail?>"></p>
  <p><input type="submit" name="submit" value="Push"></p>
</form>

<?php
// 3. По заходу на страницу запишите в куку с именем test текст '123'.
// Затем обновите страницу и выведите содержимое этой куки на экран.
session_start();
if (!isset($_COOKIE['test'])) {
    setcookie('test' , '123', time() + 60);
} else {
    echo "<p> {$_COOKIE['test']} </p>";
}

//4. Удалите куку с именем test.
session_start();
if (!isset($_COOKIE['test'])) {
    setcookie('test' , '123', time() + 60);
    setcookie('value' , '1', time() + 60);
} if($_COOKIE['value'] < 3) {
    echo "<p> {$_COOKIE['test']} </p>";
    echo "<p> {$_COOKIE['value']} </p>";
    $_COOKIE['value'] += 1;
    setcookie('value' , $_COOKIE['value']);
}else {
  setcookie('test' , '123', time() - 60);
  setcookie('value' , '1', time() - 60);
}


// 5. Спросите дату рождения пользователя. При следующем заходе на сайт напишите сколько
// дней осталось до его дня рождения. Если сегодня день рождения пользователя - поздравьте его!

session_start();
if (!isset($_COOKIE['birthday'])) {
  setcookie('birthday', $_POST['birthday'], time() + 10);
}if(isset($_COOKIE['birthday'])){
   daysToBirthday($_COOKIE['birthday']);
}


function daysToBirthday($value){
  $birthday = $value;
  $splitBirthdayExplode = explode('.', $birthday);
  $splitBirthday = mktime(0, 0, 0, $splitBirthdayExplode[1], $splitBirthdayExplode[0], date('Y'));
  $c = strtotime(date('d.m.Y'));
  if ($splitBirthday == $c) {
    echo "С Днем Рождения!";
  }
  if ($splitBirthday > $c) {
    $examination = intval(($splitBirthday - time())/86400);
    echo "До вашего дня рождения осталось: {$examination}";
  }
  if ($splitBirthday < $c){
    $splitBirthday = mktime(0, 0, 0, $splitBirthdayExplode[1], $splitBirthdayExplode[0], date('Y')+1);
    $examination = intval(($splitBirthday - time())/86400);
    echo "До вашего дня рождения осталось: {$examination}";
  }
}

?>

<form action="" method="post">
  <p>Когда у вас день рождения? <input type="text" name="birthday" placeholder="В формате дд.мм.гггг"></p>
  <p><input type="submit" name="submit" value="Push"></p>
</form>
