<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

// Проверяем, есть ли ошибки подключения
if ($db == false) {
    echo 'Ошибка подключения';
    exit;
}


// Удаление записи из таблицы user
if (isset($_POST['user-btn-delete'])) {
  $id_user = $_POST['id_user'];
  $userDel = "DELETE FROM user WHERE id_user = '$id_user'";
  $userDel_result = mysqli_query($db, $userDel);
  if ($userDel_result) {
    echo
    "<script>alert('Пользователь успешно удален');history.go(-1);
        </script>";
  } else {
    echo
    "<script>alert('Ошибка удаления пользователя');history.go(-1);</script>";
	
	}
}

// Удаление записи из таблицы book
if (isset($_POST['book-btn-delete'])) {
  $id_book = $_POST['id_book'];
  $book = "DELETE FROM book WHERE id_book = '$id_book'";
  $book_result = mysqli_query($db, $book);
  if ($book_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);
    </script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}
// Удаление записи из таблицы author
if (isset($_POST['author-btn-delete'])) {
  $id_author = $_POST['id_author'];
  $author = "DELETE FROM author WHERE id_author = '$id_author'";
  $author_result = mysqli_query($db, $author);
  if ($author_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}
// Удаление записи из таблицы country
if (isset($_POST['country-btn-delete'])) {
  $id_country = $_POST['id_country'];
  $country = "DELETE FROM country WHERE id_country = '$id_country'";
  $country_result = mysqli_query($db, $country);
  if ($country_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}
// Удаление записи из таблицы genre
if (isset($_POST['genre-btn-delete'])) {
  $id_genre = $_POST['id_genre'];
  $genre = "DELETE FROM genre WHERE id_genre = '$id_genre'";
  $genre_result = mysqli_query($db, $genre);
  if ($genre_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}

// Удаление записи из таблицы translator
if (isset($_POST['translator-btn-delete'])) {
  $id_translator = $_POST['id_translator'];
  $translator = "DELETE FROM translator WHERE id_translator = '$id_translator'";
  $translator_result = mysqli_query($db, $translator);
  if ($translator_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}

// Удаление записи из таблицы sale
if (isset($_POST['sale-btn-delete'])) {
  $id_sale = $_POST['id_sale'];
  $sale = "DELETE FROM sale WHERE id_sale = '$id_sale'";
  $sale_result = mysqli_query($db, $sale);
  if ($sale_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}

// Удаление записи из таблицы news
if (isset($_POST['news-btn-delete'])) {
  $id_news = $_POST['id_news'];
  $news = "DELETE FROM news WHERE id_news = '$id_news'";
  $news_result = mysqli_query($db, $news);
  if ($news_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}

// Удаление записи из таблицы exemplyar
if (isset($_POST['exemplyar-btn-delete'])) {
  $id_exemplyar = $_POST['id_exemplyar'];
  $exemplyar = "DELETE FROM exemplyar WHERE id_exemplyar = '$id_exemplyar'";
  $exemplyar_result = mysqli_query($db, $exemplyar);
  if ($exemplyar_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}
		
// Удаление записи из таблицы achieve
if (isset($_POST['achieve-btn-delete'])) {
  $id_achieve = $_POST['id_achieve'];
  $achieve = "DELETE FROM achieve WHERE id_achieve = '$id_achieve'";
  $achieve_result = mysqli_query($db, $achieve);
  if ($achieve_result) {
    echo
    "<script>alert('Запись успешно удалена');history.go(-1);</script>";
  } else {
    echo
    "<script>alert('Ошибка удаления записи');history.go(-1);</script>";
  }
}

// Закрываем подключение к базе данных
$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/scss/style.css" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
    <title>Document</title>
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

        <div class="add-forms">

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить пользователя</h2>

		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    	<label for="id_user">ID пользователя:</label><br>
    	<input class='form-add-input' type="text" id="id_user" name="id_user" required><br>
    	
    	<input class='button' type="submit" value="Удалить" name='user-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить книгу</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

    <label for="id_book">ID книги:</label><br>
    	<input class='form-add-input' type="text" id="id_book" name="id_book" required><br>

    <input class='button' type="submit" value="Удалить" name='book-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить автора</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_author">ID Автора:</label><br>
    	<input class='form-add-input' type="text" id="id_author" name="id_author" required><br>

    	<input class='button' type="submit" value="Удалить" name='author-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2	h2 class='form-add-title'>Удалить страну</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    	<label for="id_country">ID Страны:</label><br>
    	<input class='form-add-input' type="text" id="id_country" name="id_country" required><br>

    	<input class='button' type="submit" value="Удалить" name='country-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить жанр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" 	method="post">

    	<label for="id_genre">ID Жанра:</label><br>
    	<input class='form-add-input' type="text" id="id_genre" name="id_genre" required><br>

    	<input class='button' type="submit" value="Удалить" name='genre-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить переводчика</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    	<label for="id_translator">ID Переводчика:</label><br>
    	<input class='form-add-input' type="text" id="id_translator" name="id_translator" required><br>

    	<input class='button' type="submit" value="Удалить" name='translator-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить акцию</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

		<label for="id_sale">ID Акции:</label><br>
    	<input class='form-add-input' type="text" id="id_sale" name="id_sale" required><br>
    	
    	<input class='button' type="submit" value="Удалить акцию" name='sale-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить новость</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_news">ID Новости: </label><br>
    	<input class='form-add-input' type="text" id="id_news" name="id_news" required><br>

    	<input class='button' type="submit" value="Удалить новость" name='news-btn-delete'>
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Удалить экземпляр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_exemplyar">ID Экземпляра: </label><br>
    	<input class='form-add-input' type="text" id="id_exemplyar" name="id_exemplyar" required><br>


    <input class='button' type="submit" value="Удалить экземпляр" name='exemplyar-btn-delete'>
		</form>
	</div>


    <div class="add-forms-part">
		<h2 class='form-add-title'>Удалить достижение</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="id_achieve">ID Достижения: </label><br>
    	<input class='form-add-input' type="text" id="id_achieve" name="id_achieve" required><br>

    	<input class='button' type="submit" value="Удалить" name='achieve-btn-delete'>
		</form>
	</div>
	

</div>

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








