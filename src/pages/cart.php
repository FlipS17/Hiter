<?php
session_start();

// Establish a connection to the database
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

if (!$db) {
    die("Connection failed: ". mysqli_connect_error());
}

if (isset($_POST['add_to_cart'])) {
    if ($_SESSION['id_user'] == null) {
        echo "<script>alert('Вы не авторизованы');</script>";
    } else {
        if (is_null($_SESSION['id_book'])) {
            echo "<script>alert('не нашел книгу');</script>";
        } else {
            $query = $db->prepare("INSERT INTO cart (id_book, id_user) VALUES (?,?)");
            $query->bind_param("ii", $_SESSION['id_book'], $_SESSION['id_user']);
            $query->execute();
        }
    }
}

if (isset($_POST['update_cart'])) {
    $id_book = $_POST['id_book'];
    $id_user = $_SESSION['id_user'];
    $quantity = $_POST['quantity'];

    $query = $db->prepare("SELECT * FROM cart WHERE id_book =? AND id_user =?");
    $query->bind_param("ii", $id_book, $id_user);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_cart = $row['id_cart'];

        if ($quantity > 0) {
            $query = $db->prepare("UPDATE cart SET quantity =? WHERE id_cart =?");
            $query->bind_param("ii", $quantity, $id_cart);
            $query->execute();
        } else {
            $query = $db->prepare("DELETE FROM cart WHERE id_cart =?");
            $query->bind_param("i", $id_cart);
            $query->execute();
        }
    }
}

if (isset($_POST['get_cart_total'])) {
    $id_user = $_SESSION['id_user'];

    $query = $db->prepare("SELECT SUM(b.cost * c.quantity) AS total FROM cart c JOIN book b ON c.id_book = b.id_book WHERE c.id_user =?");
    $query->bind_param("i", $id_user);
    $query->execute();
    $result = $query->get_result();

    $row = $result->fetch_assoc();
    $total = $row['total'];

    echo "<p>Итого: $total р.</p>";
    exit();
}

if (isset($_POST['delete_cart_item'])) {
    $id_book = $_POST['id_book'];
    $id_user = $_SESSION['id_user'];

    $query = $db->prepare("DELETE FROM cart WHERE id_book =? AND id_user =?");
    $query->bind_param("ii", $id_book, $id_user);
    $query->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="/src/img/favicon.png" />
		<link rel="stylesheet" href="../scss/style.css" />

		<title>Корзина</title>
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

		<section class="cart">
			<div class="cart__container">
				<h2 class="cart__title">Корзина</h2>
				<p class="cart__text">Тут пока ничего нет</p>
			</div>

			<div class="cart__inner">

				<div class="cart__inner-product">
					<img class='cart__inner-product-img' src='/src/img/book/book.png'>

					<div class="cart__inner-product-info">
						<p class='cart__inner-product-info-text'>Почему мы так долго спим?</p>
						<p class='cart__inner-product-info-text'>Дмитрий Лебедев</p>
						<p class='cart__inner-product-info-text colored'>690 ₽</p>
					</div>

				<div class="cart__inner-product-move">

					<div class="cart__inner-product-move-count">
						<button class='cart__inner-product-move-count-more'>+</button>
						<p class='cart__inner-product-move-count-number'>1</p>
						<button class='cart__inner-product-move-count-less'>-</button>
					</div>

					<div class="cart__inner-product-move-delete">
						<img src='/src/img/cart/Delete.png'>
						<p class='cart__inner-product-move-delete-text'>Удалить</p>
					</div>
				</div>
			</div>

			<div class="cart__inner-aside">

			<div class="cart__inner-aside-part">
				<input class='cart__inner-aside-part-input request__input' placeholder='Купон'>
				<button class='button'>Применить</button>
			</div>

			<div class="cart__inner-aside-part">
				<p class='cart__inner-aside-part-amount'>1 товар</p>

				<div class="cart__inner-aside-part-cost">
					<p class='cart__inner-aside-part-cost-text'>Стоимость</p>
					<p class='cart__inner-aside-part-cost-number'>690p</p>
				</div>

				<div class="cart__inner-aside-part-sale">
					<p class='cart__inner-aside-part-sale-text'>Скидка</p>
					<p class='cart__inner-aside-part-sale-number'>-219p</p>
				</div>
			</div>

			<div class="cart__inner-aside-part">
				<div class="cart__inner-aside-part-total">
					<p class='cart__inner-aside-part-total-text'>Итого</p>
					<p class='cart__inner-aside-part-total-number'>417р</p>
				</div>

				<div class="cart__inner-aside-part-delivery">
					<p class='cart__inner-aside-part-delivery-text'>Доставка</p>
					<p class='cart__inner-aside-part-delivery-number'>Бесплатно</p>
				</div>

				<button class='button'>Оформить</button>
			</div>
			<p class='cart-warning'>*Оплата только при получении</p>
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
