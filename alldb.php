<?php
// Подключение к базе данных
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

if (!$db) {
  die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Query book table
$bookView = "SELECT * FROM book";
$bookView_result = mysqli_query($db, $bookView);

// Query user table
$usersView = "SELECT * FROM user";
$usersView_result = mysqli_query($db, $usersView);

// Query achieve table
$achieveView = "SELECT * FROM achieve";
$achieveView_result = mysqli_query($db, $achieveView);

// Query author table
$authorView = "SELECT * FROM author";
$authorView_result = mysqli_query($db, $authorView);

// Query beAuthor table
$beAuthorView = "SELECT * FROM beAuthor";
$beAuthorView_result = mysqli_query($db, $beAuthorView);

// Query beParthner table
$beParthnerView = "SELECT * FROM beParthner";
$beParthnerView_result = mysqli_query($db, $beParthnerView);

// Query cart table
$cartView = "SELECT * FROM cart";
$cartView_result = mysqli_query($db, $cartView);

// Query country table
$countryView = "SELECT * FROM country";
$countryView_result = mysqli_query($db, $countryView);

// Query exemplyar table
$exemplyarView = "SELECT * FROM exemplyar";
$exemplyarView_result = mysqli_query($db, $exemplyarView);

// Query genre table
$genreView = "SELECT * FROM genre";
$genreView_result = mysqli_query($db, $genreView);

// Query news table
$newsView = "SELECT * FROM news";
$newsView_result = mysqli_query($db, $newsView);

// Query sale table
$saleView = "SELECT * FROM sale";
$saleView_result = mysqli_query($db, $saleView);

// Query translator table
$translatorView = "SELECT * FROM translator";
$translatorView_result = mysqli_query($db, $translatorView);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/src/scss/style.css" />
  <title>База данных</title>
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
  <div class="container">
    <h2 class="admin_title">Книги</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">ID автора</th>
          <th class="popup__block-text">ID жанра</th>
          <th class="popup__block-text">Дата публикации</th>
          <th class="popup__block-text">Стоимость</th>
          <th class="popup__block-text">ID переводчика</th>
          <th class="popup__block-text">Название</th>
          <th class="popup__block-text">Фото</th>
          <th class="popup__block-text">Описание</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($bookView_result)) { ?>
          <tr>
            <td class="popup__block-text"><?= $row['id_book'] ?></td>
            <td class="popup__block-text"><?= $row['id_author'] ?></td>
            <td class="popup__block-text"><?= $row['id_genre'] ?></td>
            <td class="popup__block-text"><?= $row['date_publish'] ?></td>
            <td class="popup__block-text"><?= $row['cost'] ?></td>
            <td class="popup__block-text"><?= $row['id_translator'] ?></td>
            <td class="popup__block-text"><?= $row['name'] ?></td>
            <td class="popup__block-text"><?= $row['photo'] ?></td>
            <td class="popup__block-text"><?= $row['description'] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <h2 class="admin_title">Пользователи</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Имя</th>
          <th class="popup__block-text">Фамилия</th>
          <th class="popup__block-text">Отчество</th>
          <th class="popup__block-text">Email</th>
          <th class="popup__block-text">Логин</th>
          <th class="popup__block-text">Пароль</th>
          <th class="popup__block-text">Роль</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($usersView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_user']?></td>
            <td class="popup__block-text"><?= $row['name']?></td>
            <td class="popup__block-text"><?= $row['surname']?></td>
            <td class="popup__block-text"><?= $row['otch']?></td>
            <td class="popup__block-text"><?= $row['email']?></td>
            <td class="popup__block-text"><?= $row['login']?></td>
            <td class="popup__block-text"><?= $row['password']?></td>
            <td class="popup__block-text"><?= $row['role']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Достижения</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">ID автора</th>
          <th class="popup__block-text">Название 1</th>
          <th class="popup__block-text">Название 2</th>
          <th class="popup__block-text">Название 3</th>
          <th class="popup__block-text">Название 4</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($achieveView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_achieve']?></td>
            <td class="popup__block-text"><?= $row['id_author']?></td>
            <td class="popup__block-text"><?= $row['title1']?></td>
            <td class="popup__block-text"><?= $row['title2']?></td>
            <td class="popup__block-text"><?= $row['title3']?></td>
            <td class="popup__block-text"><?= $row['title4']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Авторы</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">ФИО</th>
          <th class="popup__block-text">Дата рождения</th>
          <th class="popup__block-text">ID страны</th>
          <th class="popup__block-text">Маленькое фото</th>
          <th class="popup__block-text">Большое фото</th>
          <th class="popup__block-text">Дополнительное фото</th>
         <th class="popup__block-text">Верхнее описание</th>
          <th class="popup__block-text">Нижнее описание</th>
          <th class="popup__block-text">Дополнительное описание</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($authorView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_author']?></td>
            <td class="popup__block-text"><?= $row['name']?></td>
            <td class="popup__block-text"><?= $row['dateb']?></td>
            <td class="popup__block-text"><?= $row['id_country']?></td>
            <td class="popup__block-text"><?= $row['smallPhoto']?></td>
            <td class="popup__block-text"><?= $row['mainPhoto']?></td>
            <td class="popup__block-text"><?= $row['extraPhoto']?></td>
            <td class="popup__block-text"><?= $row['desktop']?></td>
            <td class="popup__block-text"><?= $row['deskbot']?></td>
            <td class="popup__block-text"><?= $row['deskextra']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Будущие авторы</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Имя</th>
          <th class="popup__block-text">Фамилия</th>
          <th class="popup__block-text">Телефон</th>
          <th class="popup__block-text">Email</th>
          <th class="popup__block-text">Описание</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($beAuthorView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_beAuthor']?></td>
            <td class="popup__block-text"><?= $row['name']?></td>
            <td class="popup__block-text"><?= $row['surname']?></td>
            <td class="popup__block-text"><?= $row['phone']?></td>
            <td class="popup__block-text"><?= $row['email']?></td>
            <td class="popup__block-text"><?= $row['description']?></td>
          </tr>
        <?php }?>
      </table>
    </div>
 
    <h2 class="admin_title">Будущие партнеры</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Имя</th>
          <th class="popup__block-text">Фамилия</th>
          <th class="popup__block-text">Телефон</th>
          <th class="popup__block-text">Email</th>
          <th class="popup__block-text">Описание</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($beParthnerView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_beParthner']?></td>
            <td class="popup__block-text"><?= $row['name']?></td>
            <td class="popup__block-text"><?= $row['surname']?></td>
            <td class="popup__block-text"><?= $row['phone']?></td>
            <td class="popup__block-text"><?= $row['email']?></td>
            <td class="popup__block-text"><?= $row['description']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Страна</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Название</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($countryView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_country']?></td>
            <td class="popup__block-text"><?= $row['countryName']?></td>
          </tr>
        <?php }?>
      </table>
    </div>


  <h2 class="admin_title">Экземпляр</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Название</th>
          <th class="popup__block-text">ID Книги</th>
          <th class="popup__block-text">Количество</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($exemplyarView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_exemplyar']?></td>
            <td class="popup__block-text"><?= $row['exemplyarName']?></td>
            <td class="popup__block-text"><?= $row['id_book']?></td>
            <td class="popup__block-text"><?= $row['amount']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

<h2 class="admin_title">Жанр</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Название</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($genreView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_genre']?></td>
            <td class="popup__block-text"><?= $row['genreName']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Новости</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Фотография</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($newsView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_news']?></td>
            <td class="popup__block-text"><?= $row['photo']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Акции</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Фотография</th>
          <th class="popup__block-text">Текст</th>
          <th class="popup__block-text">Аудитория</th>
          <th class="popup__block-text">Промокод</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($saleView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_sale']?></td>
            <td class="popup__block-text"><?= $row['photo']?></td>
            <td class="popup__block-text"><?= $row['saleText']?></td>
            <td class="popup__block-text"><?= $row['saleFor']?></td>
            <td class="popup__block-text"><?= $row['salePromo']?></td>
          </tr>
        <?php }?>
      </table>
    </div>

    <h2 class="admin_title">Переводчик</h2>
    <div class="responsive-table">
      <table>
        <tr>
          <th class="popup__block-text">ID</th>
          <th class="popup__block-text">Название</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($translatorView_result)) {?>
          <tr>
            <td class="popup__block-text"><?= $row['id_translator']?></td>
            <td class="popup__block-text"><?= $row['translatorName']?></td>
          </tr>
        <?php }?>
      </table>
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
