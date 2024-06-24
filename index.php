<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');
// Проверка на ошибки подключения к базе данных
if ($db == false) {
  echo "<script>alert('Ошибка подключения к базе данных');</script>";
  exit(); // Прекращаем выполнение скрипта, так как база недоступна
}


$sales_query = mysqli_query($db, "SELECT * FROM sale");

// Выносим автора из бд для дальнейшей работы с ним
$author = mysqli_query($db, "SELECT DISTINCT author.name FROM book
JOIN author ON book.id_author = author.id_author" );
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./src/scss/style.css" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<title>Хитёр</title>
	</head>
	<body>
		<header class="header">
			<div class="header__container container">
				<a href="index.php" class="header__logo">
					<img src="./src/img/mainpage/logo.svg" />
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
						><img src="./src/img/mainpage/account.svg" />
					</a>
					<a href="/src/pages/cart.php"
						><img src="./src/img/mainpage/cart.svg" />
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

		<section class="hero">
			<div class="hero__container">
				<h1 class="hero__title">
					Хитёр собрал вс<span class="colored">ё</span> лучшее только для тебя!
				</h1>
				<img class="hero__img" src="./src/img/mainpage/jump-fox.svg" />
			</div>
		</section>

		<section class="genre">
			<div class="genre__container">
				<h2 class="genre__title">Жанры</h2>

				<div class="genre__cards">
					<a href="#" class="genre__card">
						<img class="genre__card-img" src="./src/img/mainpage/genre1.svg" />
						<p class="genre__card-text">Детективы</p>
					</a>

					<a href="#" class="genre__card">
						<img class="genre__card-img" src="./src/img/mainpage/genre2.svg" />
						<p class="genre__card-text">Психология</p>
					</a>

					<a href="#" class="genre__card">
						<img class="genre__card-img" src="./src/img/mainpage/genre3.svg" />
						<p class="genre__card-text">Романтика</p>
					</a>

					<a href="#" class="genre__card">
						<img class="genre__card-img" src="./src/img/mainpage/genre4.svg" />
						<p class="genre__card-text">Фэнтэзи</p>
					</a>

					<a href="#" class="genre__card">
						<img class="genre__card-img" src="./src/img/mainpage/genre5.svg" />
						<p class="genre__card-text">Приключения</p>
					</a>
				</div>
			</div>
		</section>

		<section class="books">
			<div class="book__container">
				<h2 class="book__title">Книги</h2>
				<a href="/src/pages/catalog.php" class="book__more-button"
					>смотреть все →</a
				>
				<div class="book__books-cards">

<?php
      $books_query = mysqli_query($db, "SELECT * FROM book ORDER BY id_book DESC LIMIT 5");
      while ($book = mysqli_fetch_assoc($books_query)) {
        $author_id = $book['id_author'];
        $author_query = mysqli_query($db, "SELECT name FROM author WHERE id_author = $author_id");
        $author_row = mysqli_fetch_assoc($author_query);
        $author_name = $author_row['name'];
      ?>
      <a href="/src/pages/book.php?id=<?= $book['id_book']?>" class="book__books-card">
        <img
          src="/src/img/book/<?php echo $book['photo']?>"
          class="book__books-card-img"
        />
        <p class="book__books-card-name"><?php echo $book['name']?></p>
        <p class="book__books-card-author"><?php echo $author_name?></p>
        <p class="book__books-card-cost"><?php echo $book['cost']. " ". "₽"?></p>
      </a>
      <?php
      }
      ?>

				
				</div>
			</div>
		</section>

		<section class="sale">
			<div class="sale__container">
				<h2 class="sale__title">Акции</h2>
				<div class="sale__inner">
					<a
						href="/src/pages/sales.php"
						class="book__more-button sale__more-button"
						>смотреть все →</a
					>
					<div class="sale__inner-cards">

					<?php
					session_start();

					$sales_query = mysqli_query($db, "SELECT * FROM sale ORDER BY id_sale DESC LIMIT 2");
					while ($sale = mysqli_fetch_assoc($sales_query)) {
					?>
						<a href='./src/pages/sales.php'>
							<img
							src="./src/img/sales/<?php echo $sale['photo']?>"
							class="sale__inner-cards-img"
						/>
						</a>
							
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</section>

		<section class="news">
			<div class="news__container">
				<h2 class="news__title">Последние новости</h2>
				<div class="news__inner">
					<?php
					session_start();

					$news_query = mysqli_query($db, "SELECT * FROM news ORDER BY id_news DESC LIMIT 3");
					while ($news = mysqli_fetch_assoc($news_query)) {
					?>
						<img class="news__inner-img" src="/src/img/mainpage/<?php echo $news['photo']?>" />
							
						<?php
						}
						?>
				</div>
			</div>
		</section>


		<footer class="footer">
			<div class="footer__container">
				<div class="footer__nav">
					<a href="/index.html"><img src="./src/img/mainpage/logo.svg" /></a>
					<ul class="footer__nav-list">
						<a href="/src/pages/catalog.html" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Книги</li>
						</a>

						<a href="/src/pages/all-authors.html" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Авторы</li>
						</a>

						<a href="/src/pages/sales.html" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Акции</li>
						</a>

						<a href="/src/pages/parthner.html" class="footer__nav-list-link">
							<li class="footer__nav-list-item">Сотрудничество</li>
						</a>
						<a href="/src/pages/about-us.html" class="footer__nav-list-link">
							<li class="footer__nav-list-item">О нас</li>
						</a>
					</ul>
				</div>
				<img src="./src/img/mainpage/fox-footer.png" class="footer__image" />
				<div class="footer__info">
					<div class="footer__info-mail">
						<img
							class="footer__info-mail-img"
							src="./src/img/mainpage/mail.png"
						/>
						<p class="footer__info-mail-text">Hiter_Books@gmail.com</p>
					</div>
					<div class="footer__info-phone">
						<img
							class="footer__info-phone-img"
							src="./src/img/mainpage/phone.png"
						/>
						<p class="footer__info-phone-text">8 (925)-616-09-95</p>
					</div>
				</div>
			</div>
		</footer>
		<script type="module" src="./src/js/main.js"></script>
		<script src="/src/js/burger.js"></script>
	</body>
</html>
