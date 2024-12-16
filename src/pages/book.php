<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

// Проверяем наличие параметра id в URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Ошибка: параметр ID не передан');</script>";
    exit(); // Прекращаем выполнение скрипта, если параметр не передан
}

$id_book = $_GET['id'];

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
    $name = $book_data['name'];
    $cost = $book_data['cost'];
    $description = $book_data['description'];
    $photo = $book_data['photo'];
} else {
    echo "<script>alert('Книга не найдена');</script>";
    exit(); // Прекращаем выполнение скрипта, если книга не найдена
}

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
            <a href="/src/pages/account.php"><img src="/src/img/mainpage/account.svg" /></a>
            <a href="/src/pages/cart.php"><img src="/src/img/mainpage/cart.svg" /></a>
        </div>
        <div class="header__burger">
            <span class="header__burger-bar"></span>
            <span class="header__burger-bar"></span>
            <span class="header__burger-bar"></span>
        </div>
        <nav class="header__nav-mobile">
            <ul class="header__nav-mobile-menu">
                <li class="header__nav-mobile-menu-item">
                    <a href="/src/pages/catalog.php" class=" header__nav-mobile-menu-link">Книги</a>
                </li>
                <li class="header__nav-mobile-menu-item">
                    <a href="/src/pages/all-authors.php" class="header__nav-mobile-menu-link">Авторы</a>
                </li>
                <li class="header__nav-mobile-menu-item">
                    <a href="/src/pages/sales.php" class="header__nav-mobile-menu-link">Акции</a>
                </li>
                <li class="header__nav-mobile-menu-item">

				<a href="/src/pages/parthner.php" class="header__nav-mobile-menu-link">Сотрудничество</a>
                </li>
                <li class="header__nav-mobile-menu-item">
                    <a href="/src/pages/about-us.php" class="header__nav-mobile-menu-link">О нас</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<section class="books">
    <div class="books__container">
        <a href="javascript:history.back()" class="books__button-back">← назад</a>
        <div class="books__inner">
            <div class="books__inner-div">
                <img class="books__inner-div-img" src="/src/img/book/<?php echo $photo ?>" />
                <div class="books__inner-author">
                    <img class='books__inner-author-img' src="/src/img/author/<?php echo $author_sPhoto?>" />
                    <div class="books__inner-author-info">
                        <p class="books__inner-author-info-name"><?php echo $author_name?></p>
                        <a href="/src/pages/author.php?id=<?= $book_data['id_author']?>" class="books__inner-author-info-link">Автор →</a>
                    </div>
                </div>
            </div>

            <div class="books__inner-info">
                <h2 class="books__inner-info-title"><?php echo $name ?></h2>
                <div class="books__inner-info-about">
                    <p class="books__inner-info-about-author"><?php echo $author_name?></p>
                    <p class="books__inner-info-about-cost"><?php echo $cost . " " . "₽" ?></p>
                </div>
                <p class="books__inner-info-description"><?php echo $description ?></p>

                <button id="add-to-cart" class="books__inner-info-button">В корзину</button>
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
                <img class="footer__info-mail-img" src="/src/img/mainpage/mail.png" />
                <p class="footer__info-mail-text">Hiter_Books@gmail.com</p>
            </div>
            <div class="footer__info-phone">
                <img class="footer__info-phone-img" src="/src/img/mainpage/phone.png" />
                <p class="footer__info-phone-text">8 (925)-616-09-95</p>
            </div>
        </div>
    </div>
</footer>

<script>
// Получаем элемент кнопки "В корзину"
const addToCartButton = document.getElementById('add-to-cart');

// Проверяем наличие книги в корзине при загрузке страницы
const cart = JSON.parse(localStorage.getItem('cart')) || [];
const bookId = <?= $id_book ?>;

// Проверяем, есть ли книга в корзине
const bookInCart = cart.find(item => item.id === bookId);
if (bookInCart) {
    addToCartButton.textContent = 'В корзине'; // Изменяем текст кнопки, если книга в корзине
    addToCartButton.disabled = true; // Отключаем кнопку, если книга уже в корзине
}


// Обработчик события для добавления книги в корзину
addToCartButton.addEventListener('click', function() {
    const book = {
        id: bookId,
        name: '<?= $name ?>',
        cost: <?= $cost ?>,
        photo: '<?= $photo ?>',
        author: '<?= $author_name ?>',
        amount: 1
    };

    // Проверяем, есть ли книга в корзине
    const bookInCart = cart.find(item => item.id === bookId);

    if (bookInCart) {
        // Если книга уже в корзине, увеличиваем количество
        bookInCart.amount++;
    } else {
        // Если книги нет в корзине, добавляем ее
        cart.push(book);
    }

    // Сохраняем обновленную корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Уведомляем пользователя
    alert('Книга добавлена в корзину!');

    // Изменяем текст кнопки и отключаем ее
    addToCartButton.textContent = 'В корзине';
    addToCartButton.disabled = true;
});
</script>

<script type='module' src="/src/js/main.js"></script>
<script src="/src/js/burger.js"></script>

</body>
</html>
