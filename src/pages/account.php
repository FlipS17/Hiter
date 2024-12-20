<?php
session_start();
$log = 0;

if ($_POST) {
    $login = $_POST['login-enter'];
    $password = $_POST['password-enter'];
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA response
    $secret_key = '6LdypfkpAAAAABc2Szg0HJr0n7ABJBki1IrVC5_R';
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}&remoteip={$_SERVER['REMOTE_ADDR']}");

    $response_data = json_decode($verify_response, true);

    if ($response_data['success']) {
        // капча пройдена
        $db = mysqli_connect('localhost', 'root', '', 'Hiter');

        // берем данные из бд
        $EnterLogin = mysqli_query($db, "SELECT * from user where login = '$login'");

        // проверяем данные из бд и в форме
        if (mysqli_num_rows($EnterLogin) > 0) {
            $user_data = mysqli_fetch_assoc($EnterLogin);
            $_SESSION['user'] = $user_data;
            $_SESSION['id_user'] = $user_data['id_user'];
            $log = 1;
            echo "<script>alert('Вы успешно авторизовались!');history.go(-1);</script>";
        } else {
            echo "<script>alert('Что-то не то. Давай попробуем еще')</script>";
        }
    } else {
        // Ошибка капчи
        echo "<script>alert('Пройдите рекапчу')</script>";
    }
}

if ($log == 1) {
    // Логин успешен
    exit;
}

// Обработка выхода пользователя
if (isset($_POST['logout'])) {
    // Удаляем все переменные сессии
    $_SESSION = array();

    // Уничтожаем сессию
    session_destroy();

    // Перенаправляем на главную страницу или другую
    header('Location: http://localhost:5173/src/pages/account.php');
    exit;
}

// Determine if the user is authenticated
$is_authenticated = isset($_SESSION['user']);

// Display user data if authenticated
$user_data = $is_authenticated ? $_SESSION['user'] : array();

// Подключение к базе данных для получения заказов
$db = mysqli_connect('localhost', 'root', '', 'Hiter');
$orders = [];

if ($is_authenticated) {
    $userId = $_SESSION['id_user'];
    $orderQuery = mysqli_query($db, "
        SELECT o.id_userOrder, o.id_user, o.id_book, o.amount, o.total_price, o.status, 
               b.name AS book_name, b.photo AS book_photo, b.id_author, b.cost AS book_cost,
               a.name AS author_name
        FROM userOrder o
        JOIN book b ON o.id_book = b.id_book
        JOIN author a ON b.id_author = a.id_author
        WHERE o.id_user = '$userId'
    ");
    
    while ($order = mysqli_fetch_assoc($orderQuery)) {
        // Формируем полный путь к изображению
        $order['book_photo'] = '/src/img/book/' . $order['book_photo'];
        $orders[] = $order; // Добавляем каждый заказ в массив
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../scss/style.css" />
    <link rel="icon" type="image/png" href="/src/img/favicon.png" />
    <title>Личный кабинет</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<header class="header">
			<div class="header__container container">
				<a href="/index.php" class="header__logo">
					<img src="/src/img/mainpage/logo.svg" />
				</a>
				<ul class="header__nav-list">
					<a href="/src/pages/catalog.php" class="header__nav-list-link">
						<li class="header__nav-list-item">Книги</li>
					</a>

					<a href="/src/pages/all-authors.php" class="header__nav-list-link">
						<li class="header__nav-list-item">Авторы</li>
					</a>

					<a href="/src/pages/sales.php" class="header__nav-list-link">
						<li class="header__nav-list-item">Акции</li>
					</a>

					<a href="/src/pages/parthner.php" class="header__nav-list-link">
						<li class="header__nav-list-item">Сотрудничество</li>
					</a>
					<a href="/src/pages/about-us.php" class="header__nav-list-link">
						<li class="header__nav-list-item">О нас</li>
					</a>
				</ul>

				<div class="header__icons">
					<a href="/src/pages/account.php"
						><img src="/src/img/mainpage/account.svg" />
					</a>
					<a href="/src/pages/cart.php"
						><img src="/src/img/mainpage/cart.svg" />
					</a>
				</div>
				<div class="header__burger">
					<span class="header__burger-bar"></span>
					<span class="header__burger-bar"></span>
					<span class="header__burger-bar"></span>
				</div>
				<nav class="header__nav-mobile">
					<ul class="header__nav-mobile-menu">
						<li class="header__nav-mobile-menu-item">
							<a
								href="/src/pages/catalog.php"
								class="header__nav-mobile-menu-link"
								>Книги</a
							>
						</li>
						<li class="header__nav-mobile-menu-item">
							<a
								href="/src/pages/all-authors.php"
								class="header__nav-mobile-menu-link"
								>Авторы</a
							>
						</li>
						<li class="header__nav-mobile-menu-item">
							<a
								href="/src/pages/sales.php"
								class="header__nav-mobile-menu-link"
								>Акции</a
							>
						</li>
						<li class="header__nav-mobile-menu-item">
							<a
								href="/src/pages/parthner.php"
								class="header__nav-mobile-menu-link"
								>Сотрудничество</a
							>
						</li>
						<li class="header__nav-mobile-menu-item">
							<a
								href="/src/pages/about-us.php"
								class="header__nav-mobile-menu-link"
								>О нас</a
							>
						</li>
					</ul>
				</nav>
			</div>
		</header>

    <section class="account">
        <div class="account__container">
            <h2 class="account__title">Личный кабинет</h2>
            <div class="account-session <?php if (!$is_authenticated) echo 'none'; ?>">
                <p class='account-data'> Пользователь: <?= $user_data ['name'] . " " . $user_data['surname'] . " " . $user_data['otch'];?></p>  
                <p class='account-data'> Почта: <?= $user_data['email'];?></p> 
                <p class='account-data'> Логин: <?= $user_data['login'];?></p>  
                <form method="post" action="./account.php">
                    <button class="button exit" name="logout">Выйти</button>
                </form>
				<button onClick='adminAppear' class="admin-button button none<?php if ($user_data['role'] == 1) echo 
					"<script> document.querySelector('.admin-button').remove('none');</script>";?>">Админ-панель</button>

            </div>
            <div class="account__start <?php if ($is_authenticated) echo "none"; ?>" >
                <button class="button-enter button">Войти</button>
                <p class="account__start-text">Или</p>
                <button class="button-reg button">Зарегистрироваться</button>
            </div>
        </div>
    </section>

    <section class="orders">
    <div class="orders__container">
        <h2 class="orders__title">Последние заказы</h2>
        <?php if (empty($orders)): ?>
            <div class="orders__books-empty">
                <p class="orders__books-empty-text">Тут пока ничего нет</p>
            </div>
        <?php else: ?>
            <div class="orders__list">
                <?php foreach ($orders as $order): ?>
                    <div class="orders__item">
                        <p>Количество: <?= $order['amount']; ?></p>
                        <img src="<?= $order['book_photo']; ?>" alt="<?= $order['book_name']; ?>" class="book-photo" />
                        <p><?= $order['book_name']; ?></p>
						<p><?= $order['author_name']; ?></p>
                        <p>Общая стоимость: <?= $order['total_price']; ?> <br> (Цена книги: <?= $order['book_cost']; ?>)</p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<footer class="footer">
			<div class="footer__container">
				<div class="footer__nav">
					<a href="/index.php"><img src="/src/img/mainpage/logo.svg" /></a>
					<ul class="footer__nav-list">
						<a href="/src/pages/catalog.php" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Книги</li>
						</a>

						<a href="/src/pages/all-authors.php" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Авторы</li>
						</a>

						<a href="/src/pages/sales.php" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Акции</li>
						</a>

						<a href="/src/pages/parthner.php" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Сотрудничество</li>
						</a>
						<a href="/src/pages/about-us.php" class="footer__nav-list-link">
							<li class="footer__nav-list-item">О нас</li>
						</a>
					</ul>
				</div>
				<img src="/src/img/mainpage/fox-footer.png" class="footer__image" />
				<div class="footer__info">
					<div class="footer__info-mail">
						<img
							class="footer__info-mail-img"
							src="/src/img/mainpage/mail.png"
						/>
						<p class="footer__info-mail-text">Hiter_Books@gmail.com</p>
					</div>
					<div class="footer__info-phone">
						<img
							class="footer__info-phone-img"
							src="/src/img/mainpage/phone.png"
						/>
						<p class="footer__info-phone-text">8 (925)-616-09-95</p>
					</div>
				</div>
			</div>
		</footer>

		<div class="admin-pannel none">
					<a href='/add_data.php' class='button admin-pannel-btn'>Добавить данные</a>
					<a href='/update_data.php' class='button admin-pannel-btn'>Изменить данные</a>
					<a href='/delete_data.php' class='button admin-pannel-btn'>Удалить данные</a>
					<a href='/alldb.php' class='button admin-pannel-btn'>Просмотреть все данные</a>
					<a href='/views.php' class='button admin-pannel-btn'>Просмотреть все представления</a>
					<a href='../pages/dashboard.php' class='button admin-pannel-btn'>Dashboard</a>
		</div>


    <script type="module" src="../js/main.js"></script>
    <script src="../js/modal-enter.js"></script>
    <script src="../js/modal-reg.js"></script>
    <script src="../js/copy.js"></script>
    <script src="../js/burger.js"></script>
    <script src="../js/admin-vanish.js"></script>
</body>
<style>
	.orders__list {
    display: flex;
    flex-wrap: wrap; /* Позволяет элементам переноситься на следующую строку */
    justify-content: space-between; /* Распределяет пространство между элементами */
}

.orders__item {
    flex: 0 1 calc(25% - 10px); /* Устанавливает ширину элемента на 25% с учетом отступов */
    box-sizing: border-box; /* Учитывает отступы и границы в ширине */
    margin-bottom: 20px; /* Отступ снизу для каждого элемента */
    border: 1px solid #ccc; /* Граница для визуального отделения */
    padding: 10px; /* Внутренние отступы */
    text-align: center; /* Центрирование текста */
}

.book-photo {
    max-width: 248px;
	width: 100%; 
    height: auto; 
}
</style>

</html>