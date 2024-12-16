<?php
session_start();
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
        

        <div class="cart__inner">
            <div class="cart__inner-products"></div> <!-- Блок для товаров -->
            <div class="cart__inner-aside">

			<div class="cart__inner-aside-part">
    <input type="text" id="promo-code-input" class="promo-input" placeholder="Введите промокод" />
    <button id="apply-promo-code" class="button">Применить</button>
</div>

<div class="cart__inner-aside-part">
    <p class='cart__inner-aside-part-amount'>0 товаров</p>
    <div class="cart__inner-aside-part-cost">
        <p class='cart__inner-aside-part-cost-text'>Стоимость</p>
        <p class='cart__inner-aside-part-cost-number'>0₽</p>
    </div>
    <p class="discount-message"></p> <!-- Элемент для отображения информации о скидке -->
</div>

<div class="cart__inner-aside-part">
    <div class="cart__inner-aside-part-total">
        <p class='cart__inner-aside-part-total-text'>Итого</p>
        <p class='cart__inner-aside-part-total-number'>0₽</p>
    </div>
    <div class="cart__inner-aside-part-total">
        <p class='cart__inner-aside-part-total-text'>Доставка</p>
        <p class='cart__inner-aside-part-total-number'>Бесплатно</p>
    </div>
</div>
                    <button id="buy-btn" class='button'>Оформить</button>
                </div>
                <p class='cart-warning'>*Оплата только при получении</p>
            </div>
        </div>

        <div class="cart__empty-message" style="display: none;">
            <p>Тут пока ничего нет</p>
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
	<script type='module' src="/src/js/cart.js"></script>
	<script src="/src/js/burger.js"></script>
    <script src="/src/js/cart.js"></script> 
</body>
</html>