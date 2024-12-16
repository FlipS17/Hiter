<?php
session_start();
$db = mysqli_connect('localhost','root', '', 'Hiter' );




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
$surname = $_POST['surname'];
$otch = $_POST['otch'];
$email = $_POST['email'];
$login = $_POST['login'];
$dateb = $_POST['dateb'];
$password = $_POST['password'];
$passconfirm = $_POST['repassword'];


if ($db == false){
    echo 'Ошибка подключения';
    exit;
}



$UserMail = mysqli_query ($db, "SELECT email from user where email = '$email' ");

$UserLogin = mysqli_query($db, "SELECT login FROM user WHERE login = '$login' "); 

if (empty($name) || empty($surname) || empty($otch) || empty($email) || empty($login) || empty($dateb) || empty($password) || empty($passconfirm)) {
    echo 'Лошара';
    exit;
}

// Проверка на правильное заполнение почты
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Неправильный формат электронной почты';
    exit;
}

// Проверка на запрещенные символы в пароле
if (preg_match('/[\'",\*,\[\],\{\}]/', $password)) {
    echo "<p>Недопустимые символы в пароле</p>";
    exit;
}

if (mysqli_num_rows ($UserLogin) > 0){ 
    echo "Такой пользователь уже зарегестрирован"; 
    exit; 
} 
if (mysqli_num_rows ($UserMail) > 0){ 
    echo "Такая почта уже используется"; 
    exit; 
} 


if ($password == $passconfirm && strlen ($password) > 6 ){ 

    $sqlInsert = "INSERT INTO user SET login = '$login', email = '$email', password = '$password', name = '$name', surname = '$surname', otch = '$otch', dateb ='$dateb', role ='0' "; 

    $result = mysqli_query($db, $sqlInsert);
    
    header ('Location:http://localhost/hiter-localhost/src/pages/accout.php ');
   
    
}
}




else{ 
    echo 'Не правильно заполнены поля'; 
    exit; 
} 
?>
