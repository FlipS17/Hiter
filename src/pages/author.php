<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');
$id_author = $_GET['id'];
$_SESSION['id_author'] = $id_author;


$achieve_query = mysqli_query($db, "SELECT * FROM achieve WHERE id_author = $id_author");

$books_query = mysqli_query($db, "SELECT * FROM book WHERE id_author = $id_author ORDER BY id_book DESC LIMIT 5");
// Проверка на ошибки подключения к базе данных
if ($db == false) {
  echo "<script>alert('Ошибка подключения к базе данных');</script>";
  exit(); // Прекращаем выполнение скрипта, так как база недоступна
}
// Получаем данные об авторе из базы данных
$author_stmt = $db->prepare("SELECT * FROM author WHERE id_author = ?");
$author_stmt->bind_param("i", $id_author);
$author_stmt->execute();
$author_result = $author_stmt->get_result();

if ($author_result->num_rows > 0) {
  $book_data = $author_result->fetch_assoc();

  $_SESSION['name'] = $book_data['name'];
  $_SESSION['cost'] = $book_data['cost'];
  $_SESSION['description'] = $book_data['description'];
  $_SESSION['photo'] = $book_data['photo'];
} else {
  echo "<script>alert('Книга не найдена');</script>";
  exit(); // Прекращаем выполнение скрипта, так как Книга не найдена
}

// Получаем данные об авторе из базы данных
$author_stmt = $db->prepare("SELECT name, dateb, mainPhoto, extraPhoto, desktop, deskbot, deskextra FROM author WHERE id_author =?");

$author_stmt->bind_param("i", $book_data['id_author']);
$author_stmt->execute();
$author_result = $author_stmt->get_result();
$author_row = $author_result->fetch_assoc();
$author_name = $author_row['name'];
$author_mPhoto = $author_row['mainPhoto'];
$author_ePhoto = $author_row['extraPhoto'];
$author_desk_top = $author_row['desktop'];
$author_desk_bot = $author_row['deskbot'];
$author_desk_extra = $author_row['deskextra'];

$author_dateb = $author_row['dateb'];
$date = new DateTime($author_dateb);
$author_dateb_formatted = $date->format('d F');

// Закрываем соединение с базой данных
$author_stmt->close();
$db->close();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<link rel="stylesheet" href="../scss/style.css" />
		<title>Автор</title>
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
		<h2 class="author__title">Автор</h2>

		<section class="author">
			<div class="author__container">
				<div class="author__bio">
					<div class="author__bio-text">
						<p class="author__bio-text-name"><?php echo $_SESSION['name'] ?></p>
						<p class="author__bio-text-about">
							<?php echo $author_desk_top?>
						</p>
					</div>
					<img class='author__bio-img' src="/src/img/author/<?php echo $author_mPhoto?>" />
				</div>
			</div>
		</section>

		<section class="achieve">
			<div class="achieve__container author__container">
				<div class="achieve__cards">
<?php while ($achieve = mysqli_fetch_assoc($achieve_query)) {?>
  <div class="achieve__cards-card">
    <p class="achieve__cards-card-number">
      <?= $achieve['title1']?><span class="colored small-text"> тыс</span>
    </p>
    <p class="achieve__cards-card-text">суммарный тираж</p>
  </div>

  <div class="achieve__cards-card">
    <p class="achieve__cards-card-number">
      <span class="colored small-text">лауреат </span><?= $achieve['title2']?>
    </p>
    <p class="achieve__cards-card-text">престижных премий</p>
  </div>

  <div class="achieve__cards-card">
    <p class="achieve__cards-card-number">
      <?= $achieve['title3']?><span class="colored small-text"></span>
    </p>
    <p class="achieve__cards-card-text">рассказов, новелл</p>
  </div>

  <div class="achieve__cards-card">
    <p class="achieve__cards-card-number">
      <?= $achieve['title4']?><span class="colored small-text"> лет</span>
    </p>
    <p class="achieve__cards-card-text">стаж</p>
  </div>
  <?php }?>
				
				</div>
			</div>
		</section>

		<section class="about__author">
			<div class="about__author-container author__container">
				<img
					class="about__author-img"
					src="/src/img/author/<?php echo $author_ePhoto?>"
				/>
				<div class="about__author-biography">
					<h2 class="about__author-biography-title">Об авторе</h2>
					<p class="about__author-biography-birth">
						<span class="colored">День рождения:</span> <?php echo $author_dateb_formatted?>
					</p>
					<p class="about__author-biography-description">
						<?php echo $author_desk_bot?>
					</p>
					<p class="about__author-biography-description">
						<?php echo $author_desk_extra?>
					</p>
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
  while ($book = mysqli_fetch_assoc($books_query)) {
    $book_id = $book['id_book'];
    $book_name = $book['name'];
    $book_cost = $book['cost'];
    $book_photo = $book['photo'];
  ?>
    <a href="/src/pages/book.php?id=<?= $book_id ?>" class="book__books-card">
      <img src="/src/img/book/<?= $book_photo ?>" class="author-book-img" />
      <p class="book__books-card-name"><?= $book_name ?></p>
      <p class="book__books-card-author"><?php echo $author_name?></p>
      <p class="book__books-card-cost"><?= $book_cost ?> ₽</p>
    </a>
  <?php
  }
  ?>

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
		<script src="/src/js/main.js"></script>
		<script src="/src/js/burger.js"></script>
	</body>
</html>
