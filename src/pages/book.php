<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');


$id_book = $_GET['id'];
$_SESSION['id_book'] = $id_book;



// Сохраняем ID автора в сессии
  $_SESSION['id_author'] = $book_data['id_author'];
	
// Проверка на ошибки подключения к базе данных
if ($db == false) {
  echo "<script>alert('Ошибка подключения к базе данных');</script>";
  exit(); // Прекращаем выполнение скрипта, так как база недоступна
}
// Получаем данные о книге из базы данных
$book_stmt = $db->prepare("SELECT * FROM book WHERE id_book = ?");
$book_stmt->bind_param("i", $id_book);
$book_stmt->execute();
$book_result = $book_stmt->get_result();

if ($book_result->num_rows > 0) {
  $book_data = $book_result->fetch_assoc();

  $_SESSION['name'] = $book_data['name'];
  $_SESSION['cost'] = $book_data['cost'];
  $_SESSION['description'] = $book_data['description'];
  $_SESSION['photo'] = $book_data['photo'];
} else {
	echo "<script>alert('fff');</script>";
  
}
// if (isset($_POST['add_to_cart'])) {
// 	if (is_null($_SESSION['id_user'])) {
// 		echo "<script>alert('Вы не авторизованы');</script>";
// 		exit();
// 	}

// 	$query = $db->prepare("INSERT INTO cart (id_book, id_user) VALUES (?,?)");
// $query->bind_param("ii", $_SESSION['id_book'], $_SESSION['id_user']);
// $query->execute();


	
	
// }

// Получаем данные об авторе из базы данных
$author_stmt = $db->prepare("SELECT name, smallPhoto FROM author WHERE id_author =?");
$author_stmt->bind_param("i", $book_data['id_author']);
$author_stmt->execute();
$author_result = $author_stmt->get_result();
$author_row = $author_result->fetch_assoc();
$author_name = $author_row['name'];
$author_sPhoto = $author_row['smallPhoto'];


// Закрываем соединение с базой данных
$book_stmt->close();
$db->close();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<link rel="stylesheet" href="../scss/style.css" />
		<title>Книга</title>
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

		<section class="books">
			<div class="books__container">
				<a href="javascript:history.back()" class="books__button-back"
					>← назад</a
				>
				<div class="books__inner">
					<div class="books__inner-div">
						<img class="books__inner-div-img" src="/src/img/book/<?php echo $_SESSION['photo'] ?>" />
						<div class="books__inner-author">
							<img class='books__inner-author-img' src="/src/img/author/<?php echo $author_sPhoto?>" />
							<div class="books__inner-author-info">
								<p class="books__inner-author-info-name"><?php echo $author_name?></p>
							<a
	href="/src/pages/author.php?id=<?= $book_data['id_author']?>"
	class="books__inner-author-info-link"
	>Автор →</a>
							</div>
						</div>
					</div>

					<div class="books__inner-info">
						<h2 class="books__inner-info-title"><?php echo $_SESSION['name'] ?></h2>
						<div class="books__inner-info-about">
							<p class="books__inner-info-about-author"><?php echo $author_name?></p>
							<p class="books__inner-info-about-cost"><?php echo $_SESSION['cost'] . " " . "₽" ?></p>
						</div>
						<p class="books__inner-info-description">
							<?php echo $_SESSION['description'] ?>
						</p>

						<form method="post" action='/src/pages/cart.php'>
						<button name='add_to_cart' class="books__inner-info-button">В корзину</button>
						
						</form>

					</div>
				</div>
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
