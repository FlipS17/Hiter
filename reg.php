<?php
session_start();
$db = mysqli_connect('localhost','root', '', 'Hiter' );




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
$surname = $_POST['surname'];
$otch = $_POST['otch'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$passconfirm = $_POST['repassword'];



if ($db == false){
    echo 'Ошибка подключения';
    exit;
}


$UserMail = mysqli_query ($db, "SELECT email from user where email = '$email' ");

$UserLogin = mysqli_query($db, "SELECT login FROM user WHERE login = '$login' "); 

if (empty($name) || empty($surname) || empty($otch) || empty($email) || empty($login) || empty($password) || empty($passconfirm)) {
    echo 'Заполните все поля';
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
    echo "Такая почта уже занята";
    exit; 
} 


if ($password == $passconfirm && strlen ($password) > 6 ){ 


    //Генерируем токен
    $email_verification_token = bin2hex(random_bytes(16));

    //Добавление в бд
    $stmt = $conn->prepare("INSERT INTO user (login, email, password, role,surname,name, otch, email_verification_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log('Ошибка подготовки запроса: ' . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Ошибка подготовки запроса']);
        exit();
    }
    

    $stmt->bind_param("sssssiss", $surname, $name, $otch, $email, $password, $role, $email_verified, $email_verification_token);
    
    header ('Location:http://localhost:5173/src/pages/account.php ');

    
   
}
else{
    echo "Пароль меньше 6 символов или не совпадают.";
}
}




else{ 
    echo 'Не правильно заполнены поля'; 
    exit; 
} 



?>
