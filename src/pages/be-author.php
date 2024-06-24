<?php
session_start();
$db = mysqli_connect('localhost','root', '', 'Hiter' );


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $agree = $_POST['agree'];

    if ($db == false){
        echo 'Ошибка подключения';
        exit;
    }

    if (empty($name) || empty($surname) || empty($phone) || empty($email) || empty($description)) {
    echo "<script>alert('Заполните все поля!');history.go(-1);</script>";
    exit;
}

    // Проверка чекбокса
    if (!$agree) {
        echo "<script>alert('Вы не дали согласие на обработку персональных данных!');history.go(-1);</script>";
        exit;
    }

		// Проверка на правильное заполнение почты
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     echo "<script>alert('Не правильный формат почты!');history.go(-1);</script>";
    exit;
}

    $sqlInsert = "INSERT INTO beAuthor (name, surname, phone, email, description) VALUES ('$name', '$surname', '$phone', '$email', '$description')";
    $result = mysqli_query($db, $sqlInsert);

    if ($result) {
        header ('Location:http://localhost:5173/src/pages/be-author.php');
    } else {
        echo 'Ошибка при добавлении данных в базу данных';
    }
}


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<link rel="stylesheet" href="../scss/style.css" />

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
		<title>Стать автором</title>
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

		<section class="be-author">
			<div class="be-author__container">
				<h2 class="be-author__title">Стать автором</h2>
				<div class="be-author__advantages">
					<h2 class="be-author__advantages-title">
						Преимущества работы с нами
					</h2>
					<div class="be-author__advantages-cards">
						<div
							class="be-author__advantages-cards-card why-us__cards-card why-us__small-card"
						>
							<img
								src="/src/img/be-author/exp.svg"
								class="why-us__cards-card-img"
							/>
							<p
								class="be-author__advantages-cards-card-title why-us__cards-card-title"
							>
								Колоссальный опыт в книгоиздании
							</p>
							<p
								class="be-author__advantages-cards-card-text why-us__cards-card-text"
							>
								Наш издательский опыт исчисляется десятилетиями. Сотни авторов,
								тысячи наименований, миллионы тиражей
							</p>
						</div>

						<div
							class="be-author__advantages-cards-card why-us__cards-card why-us__small-card"
						>
							<img
								src="/src/img/be-author/book-all-formats.svg"
								class="why-us__cards-card-img"
							/>
							<p
								class="be-author__advantages-cards-card-title why-us__cards-card-title"
							>
								Уникальная система отбора рукописей
							</p>
							<p
								class="be-author__advantages-cards-card-text why-us__cards-card-text"
							>
								Мы создали многоступенчатый сервис, в котором отныне без
								внимания не остается ни одно произведение. Автору не придется
								гадать, дошла ли его рукопись, а о каждом новом этапе
								рассмотрения мы обязательно проинформируем
							</p>
						</div>

						<div
							class="be-author__advantages-cards-card why-us__cards-card why-us__small-card"
						>
							<img
								src="/src/img/be-author/rate.svg"
								class="why-us__cards-card-img"
							/>
							<p
								class="be-author__advantages-cards-card-title why-us__cards-card-title"
							>
								Индивидуальный подход
							</p>
							<p
								class="be-author__advantages-cards-card-text why-us__cards-card-text"
							>
								Каждое произведение просматривается и оценивается нашими
								сотрудниками. Мы уделяем должное внимание всем авторам, а
								оптимизированный алгоритм отбора помогает не растягивать процесс
								рассмотрения на долгие месяцы.
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="request">
			<div class="request__container">
				<form class="request__form" method='post' action='./be-author.php'>
					<input class="request__input" name='name' placeholder="Имя" />
					<input class="request__input" name='surname' placeholder="Фамилия" />
					<input class="request__input phone-input" name='phone' placeholder="Телефон" />
					<input class="request__input" name='email' placeholder="E-mail" />
					<textarea
						class="request__input textarea"
						name='description' placeholder="Содержание"
					></textarea>
					<div class="request__agree">
						<input type="checkbox" name='agree' class="request__agree-check-box" />

						<script> 
						$(document).ready(function () {
 // Применяем маску к полю ввода телефона
 $('.phone-input').inputmask({
  mask: '+7 (999) 999-99-99', // Маска для российского номера телефона
  placeholder: ' ', // Символ заполнителя
  showMaskOnHover: false, // Показывать маску при наведении
  showMaskOnFocus: true, // Показывать маску при фокусе
 });
});
</script>
						<p class="request__agree-text">
							Даю согласие на обработку персональных данных
						</p>
					</div>
					<button type='submit' class="request__button button">Отправить</button>
				</form>
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
		<script type="module" src="/src/js/main.js"></script>
		<script src="/src/js/burger.js"></script>
	</body>
</html>
