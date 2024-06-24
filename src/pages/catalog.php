<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');
// Проверка на ошибки подключения к базе данных
if ($db == false) {
  echo "<script>alert('Ошибка подключения к базе данных');</script>";
  exit(); // Прекращаем выполнение скрипта, так как база недоступна
}

$data = mysqli_query($db, "SELECT * FROM book");

$author_fetch = mysqli_query($db, "SELECT * FROM author");

$genre_fetch = mysqli_query($db, "SELECT * FROM genre");

// Выносим автора из бд для дальнейшей работы с ним
$author = mysqli_query($db, "SELECT DISTINCT author.name FROM book
JOIN author ON book.id_author = author.id_author" );


if (isset($_POST['filter'])) {
    $genre_filters = $_POST['genre'];
    $author_filters = $_POST['author'];
    $price_filters = $_POST['price']; // You'll need to add a price filter input field

    $where_clause = '';
    if (!empty($genre_filters)) {
        $where_clause.= " AND book.genre IN ('". implode("', '", $genre_filters). "')";
    }
    if (!empty($author_filters)) {
        $where_clause.= " AND book.author IN ('". implode("', '", $author_filters). "')";
    }
    if (!empty($price_filters)) {
        // You'll need to add logic to handle price filtering
    }

    $data = mysqli_query($db, "SELECT * FROM book WHERE 1=1 $where_clause");
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<link rel="stylesheet" href="../scss/style.css" />
		<title>Каталог книг</title>
	</head>
	<body>
		<header class="header">
			<div class="header__container container">
				<a href="index.php" class="header__logo">
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

		<section class="catalog">
			<div class="catalog__container">
				<div class="catalog__top">
					<h2 class="catalog__top-title">Каталог книг</h2>
					<div id="dropdown"></div>
					<div class="all-authors-top__input">
						<svg
							width="20"
							height="20"
							viewBox="0 0 20 20"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M19 19L14.6569 14.6569M14.6569 14.6569C16.1046 13.2091 17 11.2091 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17C11.2091 17 13.2091 16.1046 14.6569 14.6569Z"
								stroke="#292929"
								stroke-linecap="round"
								stroke-linejoin="round"
							/>
						</svg>
						<input class="search__input" type="text" />
					</div>
				</div>
				<div class="catalog__aside">
					<div class="catalog__aside-filters">
						<form action="catalog.php" method="post" class="catalog__aside-filters-filter">
							<p class="catalog__aside-filters-filter-title">Жанр</p>
							

							
							<?php
        			session_start();
        			while ($filter = mysqli_fetch_assoc($genre_fetch)) {
    					$genre_id = $filter['id_genre'];
    					$genre_query = mysqli_query($db, "SELECT  genreName FROM genre");
    					$author_row = mysqli_fetch_assoc($genre_query);
							
   						?>

    					<div class="catalog__aside-filters-filter-choice">
							<input
									type="checkbox" name="genre"
									class="catalog__aside-filters-filter-choice-checkbox request__agree-check-box"
								/>
								<p class="catalog__aside-filters-filter-choice-text"><?php echo $filter['genreName']?></p>
							</div>
        			<?php
        			}
        			?>
							


							
						</form>

						<form action="catalog.php" method="post" class="catalog__aside-filters-filter">
							<p class="catalog__aside-filters-filter-title">Автор</p>
							<div
								class="all-authors-top__input catalog__aside-filters-filter-search"
							>
								<input class="search__input catalog-author-search" type="text" placeholder="Поиск" />
							</div>
							
							<?php
        			session_start();
        			while ($filter = mysqli_fetch_assoc($author_fetch)) {
    						$author_id = $filter['id_author'];
    						$author_query = mysqli_query($db, "SELECT Distinct name FROM author WHERE id_author = $author_id");
    						$author_row = mysqli_fetch_assoc($author_query);
    						$author_name = $author_row['name'];

   							?>
    						<div class="catalog__aside-filters-filter-choice">
														<input
									type="checkbox" name="author"
									class="catalog__aside-filters-filter-choice-checkbox request__agree-check-box"
														/>
														<p class="catalog__aside-filters-filter-choice-text">
															<?php echo $author_name?>
														</p>
													</div>
        								<?php
        								}
        								?>
							

							
						</form>


						<div class="catalog__aside-filters-filter">
							<p class="catalog__aside-filters-filter-title">Цена</p>
							<form action="catalog.php" method="post" class="cost-filter">
								<div class="catalog__aside-filters-filter-choice">
									<input
										type="text"
										placeholder="От"
										class="filter__cost-input"
									/>
									<input
										type="text"
										placeholder="До"
										class="filter__cost-input"
									/>
								</div>
							</form>
						</div>

						<form action="catalog.php" method="post">
						<button type='submit' name="filter" class="filter-button button">Применить</button>
					</form>

					</div>
					<div class="catalog__aside-books">
						
						<?php
        			session_start();
        			while ($card = mysqli_fetch_assoc($data)) {
    $author_id = $card['id_author'];
    $author_query = mysqli_query($db, "SELECT name FROM author WHERE id_author = $author_id");
    $author_row = mysqli_fetch_assoc($author_query);
    $author_name = $author_row['name'];

   ?>
    <a href="/src/pages/book.php?id=<?= $card['id_book']?>" class="book__books-card">
        <img
            src="/src/img/book/<?php echo $card['photo']?>"
            class="book__books-card-img"
        />
        <p class="book__books-card-name"><?php echo $card['name']?></p>
        <p class="book__books-card-author"><?php echo $author_name?></p>
        <p class="book__books-card-cost"><?php echo $card['cost']. " ". "₽"?></p>
    </a>
        		<?php
        		}
        		?>


					</div>
				</div>
			</div>
		</section>

		<footer class="footer">
			<div class="footer__container">
				<div class="footer__nav">
					<a href="/index.html"><img src="/src/img/mainpage/logo.svg" /></a>
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
		<script type="module" src="../js/main.js"></script>
		<script  src="../js/burger.js"></script>
		<script  src="../js/search-book.js"></script>
		<script  src="../js/catalog-author-search.js"></script>
	</body>
</html>
