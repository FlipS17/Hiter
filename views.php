<?php
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

if (!$db) {
	die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/src/scss/style.css" />
	<link rel="icon" type="image/png" href="/src/img/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Представления</title>
</head>

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

<body class="page">
	<div class="container views__container">
		<div class="views__block">
			<div class="views__text">
				<h2 class="admin_title">Какое представление вывести?</h2>
				<form method="post" class="views__text-request">
					<button type="submit" name="request1" class="views__text-request">1. Получить список всех книг определенного автора:</button>
					<button type="submit" name="request2" class="views__text-request">2. Получить список всех книг определенного жанра:</button>
					<button type="submit" name="request3" class="views__text-request">3. Получить список всех книг, сортированных по году выпуска в порядке убывания:</button>
					<button type="submit" name="request4" class="views__text-request">4. Получить список всех авторов, у которых количество книг в издательстве превышает заданное значение:</button>
					<button type="submit" name="request5" class="views__text-request">5. Получить список всех книг, у которых цена превышает заданное значение:</button>
					<button type="submit" name="request6" class="views__text-request">6. Получить список всех книг, у которых осталось менее определенного количества экземпляров в наличии:</button>
					<button type="submit" name="request7" class="views__text-request">7. Получить список всех книг, выпущенных в определенный год: </button>
					<button type="submit" name="request8" class="views__text-request">8.  Получить список всех жанров, у которых есть книги в издательстве: </button>
					<button type="submit" name="request9" class="views__text-request">9. Получить список всех книг иностранных авторов с указанием переводчиков</button>
					<button type="submit" name="request10" class="views__text-request">10. Получить список всех авторов с указанием всех книг определенного жанра, выпущенными ими за определенный период.</button>
				</form>
			</div>
			<div class="answer">
				<?php
				if (isset($_POST['request1'])) {
					$id_author = $_POST['id_author'];
					
					$query1 = "SELECT * FROM book WHERE id_author = 2;";

					// Execute the query
					$result1 = mysqli_query($db, $query1);

					// Check if the query was successful
					if (!$result1) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result1)) {
						echo "<li class='popup__block-text'>";
						echo  "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
						echo "</li>";
					}
					echo "</ul>";




				} elseif (isset($_POST['request2'])) {
					$id_genre = $_POST['id_genre'];
					$query2 = "SELECT * FROM book WHERE id_genre = 4";

					// Execute the query
					$result2 = mysqli_query($db, $query2);

					// Check if the query was successful
					if (!$result2) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result2)) {
						echo "<li class='popup__block-text'>";
						echo  "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
						echo "</li>";
					}
					echo "</ul>";


				} elseif (isset($_POST['request3'])) {
					$date_publish = $_POST['date_publish'];
					$query3 = "SELECT * FROM book ORDER BY date_publish DESC;";

					// Execute the query
					$result3 = mysqli_query($db, $query3);

					// Check if the query was successful
					if (!$result3) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result3)) {
						echo "<li class='popup__block-text'>";
						echo  "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
					}
					echo "</ul>";


				} elseif (isset($_POST['request4'])) {
					$id_author = $_POST['id$id_author'];

					$query4 = "SELECT * FROM author WHERE (SELECT COUNT(*) FROM book WHERE book.id_author = author.id_author) > 1";

					// Execute the query
					$result4 = mysqli_query($db, $query4);

					// Check if the query was successful
					if (!$result4) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result4)) {
						echo "<li class='popup__block-text'>";
						echo  "ID автора: " . $row['id_author'] . ", Имя фамилия: " . $row['name'] . ", Дата рождения: " . $row['dateb'] . ", Страна: " . $row['id_country'] . ", Маленькое фото: " . $row['smallPhoto'] . ", Главное фото: " . $row['mainPhoto'] . ", Дополнительное фото: " . $row['extraPhoto'] . ", Верхнее описание: " . $row['desktop'] . ", Нижнее описание: " . $row['deskbot'] . ", Дополнительное описание: " . $row['deskextra'];
					}
					echo "</ul>";



				} elseif (isset($_POST['request5'])) {
					$id_book = $_POST['id_book'];
					$query5 = "SELECT * FROM book WHERE cost > 1000";

					// Execute the query
					$result5 = mysqli_query($db, $query5);

					// Check if the query was successful
					if (!$result5) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result5)) {
						echo "<li class='popup__block-text'>";
						echo  "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
						echo "</li>";
					}
					echo "</ul>";



				} elseif (isset($_POST['request6'])) {
					$query6 = "SELECT book.id_book, book.name AS BookName
					FROM book
					JOIN exemplyar ON book.id_book = exemplyar.id_book
					WHERE exemplyar.amount < 10";

					// Execute the query
					$result6 = mysqli_query($db, $query6);

					// Check if the query was successful
					if (!$result6) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result6)) {
						echo "<li class='popup__block-text'>";
						echo "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
						echo "</li>";
					}
					echo "</ul>";


				} elseif (isset($_POST['request7'])) {
					$query7 = "SELECT id_book FROM book WHERE CAST(date_publish AS UNSIGNED) = 2024";

					// Execute the query
					$result7 = mysqli_query($db, $query7);

					// Check if the query was successful
					if (!$result7) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result7)) {
						echo "<li class='popup__block-text'>";
						echo "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'];
						echo "</li>";
					}
					echo "</ul>";



				} elseif (isset($_POST['request8'])) {
					
					$query8 = "SELECT genreName FROM genre WHERE id_genre IN (SELECT id_genre FROM book)";

					// Execute the query
					$result8 = mysqli_query($db, $query8);

					// Check if the query was successful
					if (!$result8) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result8)) {
						echo "<li class='popup__block-text'>";
						echo "Жанр: " . $row['genreName'];

						echo "</li>";
					}
					echo "</ul>";


				} elseif (isset($_POST['request9'])) {
					
					$query9 = "SELECT book.*, translator.translatorName FROM book
LEFT JOIN translator ON book.id_translator = translator.id_translator
WHERE book.id_author IN (SELECT id_author FROM author WHERE id_country != 1)";

					// Execute the query
					$result9 = mysqli_query($db, $query9);

					// Check if the query was successful
					if (!$result9) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result9)) {
						echo "<li class='popup__block-text'>";
						echo  "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'] . ", Переводчик: " . $row['translatorName'];
						echo "</li>";
					}
					echo "</ul>";



				} elseif (isset($_POST['request10'])) {
					$id_translator = $_POST['id_translator'];

					$query10 = "SELECT a.*, b.*, g.genreName FROM author a JOIN book b ON a.id_author = b.id_author JOIN genre g ON b.id_genre = g.id_genre WHERE g.genreName = 'Приключения' AND b.date_publish BETWEEN '2010-01-01' AND '2024-12-31' ORDER BY a.id_author, b.date_publish";

					// Execute the query
					$result10 = mysqli_query($db, $query10);

					// Check if the query was successful
					if (!$result10) {
						die("Query failed: " . mysqli_error($db));
					}

					// Display the results
					echo "<h2 class='admin_title views_rez'>Результат:</h2>";
					echo "<ul class='rez-ul'>";
					while ($row = mysqli_fetch_assoc($result10)) {
						echo "<li class='popup__block-text'>";
						echo "ID книги: " . $row['id_book'] . ", ID автора: " . $row['id_author'] . ", ID жанра: " . $row['id_genre'] . ", Дата публикации: " . $row['date_publish'] . ", Цена: " . $row['cost'] . ", Id переводчика: " . $row['id_translator'] . ", Название: " . $row['name'] . ", Обложка: " . $row['photo'] . ", Описание: " . $row['description'] . ", Жанр: " . $row['genreName'] . "ID автора: " . $row['id_author'] . ", Имя фамилия: " . $row['name'] . ", Дата рождения: " . $row['dateb'] . ", Страна: " . $row['id_country'] . ", Маленькое фото: " . $row['smallPhoto'] . ", Главное фото: " . $row['mainPhoto'] . ", Дополнительное фото: " . $row['extraPhoto'] . ", Верхнее описание: " . $row['desktop'] . ", Нижнее описание: " . $row['deskbot'] . ", Дополнительное описание: " . $row['deskextra'];
						echo "</li>";
					}
					echo "</ul>";
				}
				?>
			</div>
		</div>
	</div>
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

		<script type="module" src="./src/js/main.js"></script>
		<script src="./src/js/burger.js"></script>
</body>

</html>