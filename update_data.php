<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

if (!$db) {
  die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
// изменяем в User
if (isset($_POST['user-btn'])) {
  $id_user = $_POST['id_user']; 
  $user_name = $_POST['user-name']; 
  $user_surname = $_POST['user-surname']; 
  $user_otch = $_POST['user-otch']; 
  $user_email = $_POST['user-email']; 
	$user_login = $_POST['user-login']; 
	$user_password = $_POST['user-password']; 
	$user_role = $_POST['user-role']; 

  $updateQuery = "UPDATE user SET ";
  $updateValues = array();

  if (!empty($comment)) {
    $updateValues[] = "id_user = '$id_user'";
  }
  if (!empty($user_name)) {
    $updateValues[] = "name = '$user_name'";
  }
	if (!empty($user_surname)) {
    $updateValues[] = "surname = '$user_surname'";
  }
  if (!empty($user_otch)) {
    $updateValues[] = "otch = '$user_otch'";
  }
  if (!empty($user_email)) {
    $updateValues[] = "email= '$user_email'";
  }
  if (!empty($user_login)) {
    $updateValues[] = "login = '$user_login'";
  }
	 if (!empty($user_password)) {
    $updateValues[] = "password = '$user_password'";
  }

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_user = '$id_user'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в book
if (isset($_POST['book-btn'])) {
  $id_book = $_POST['id_book']; 
  $id_author = $_POST['id_author']; 
  $id_genre = $_POST['id_genre']; 
	$date_publish = $_POST['date_publish']; 
  $book_cost = $_POST['book_cost']; 
	$id_translator = $_POST['id_translator']; 
	$book_name = $_POST['book_name']; 
	$book_photo = $_FILES["book_photo"]["name"];
	$book_description = $_POST['book_description']; 


  $updateQuery = "UPDATE book SET ";
  $updateValues = array();

  if (!empty($id_book)) {
    $updateValues[] = "id_book = '$id_book'";
  }
  if (!empty($id_author)) {
    $updateValues[] = "id_author = '$id_author'";
  }
	if (!empty($id_genre)) {
    $updateValues[] = "id_genre = '$id_genre'";
  }
  if (!empty($date_publish)) {
    $updateValues[] = "date_publish = '$date_publish'";
  }
  if (!empty($book_cost)) {
    $updateValues[] = "cost= '$book_cost'";
  }
  if (!empty($id_translator)) {
    $updateValues[] = "id_translator = '$id_translator'";
  }
	 if (!empty($book_name)) {
    $updateValues[] = "name = '$book_name'";
  }
	 if (!empty($book_photo)) {
    $updateValues[] = "photo = '$book_photo'";
  }
	 if (!empty($book_description)) {
    $updateValues[] = "description = '$book_description'";
  }

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_book = '$id_book'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в author
if (isset($_POST['author-btn'])) {
  $id_author = $_POST['id_author']; 
  $author_name = $_POST['author_name']; 
	$dateb = $_POST['dateb']; 
  $id_country = $_POST['id_country'];  
	$smallPhoto = $_FILES["smallPhoto"]["name"];
	$mainPhoto = $_FILES["mainPhoto"]["name"];
	$extraPhoto = $_FILES["extraPhoto"]["name"];
	$desktop = $_POST['desktop']; 
	$deskbot = $_POST['deskbot']; 
	$deskextra = $_POST['deskextra']; 

  $updateQuery = "UPDATE author SET ";
  $updateValues = array();

  if (!empty($id_author)) {
    $updateValues[] = "id_author = '$id_author'";
  }
	if (!empty($author_name)) {
    $updateValues[] = "name = '$author_name'";
  }
  if (!empty($dateb)) {
    $updateValues[] = "dateb = '$dateb'";
  }
  if (!empty($id_country)) {
    $updateValues[] = "id_country = '$id_country'";
  }
  if (!empty($smallPhoto)) {
    $updateValues[] = "smallPhoto = '$smallPhoto'";
  }
	 if (!empty($mainPhoto)) {
    $updateValues[] = "mainPhoto = '$mainPhoto'";
  }
	 if (!empty($extraPhoto)) {
    $updateValues[] = "extraPhoto = '$extraPhoto'";
  }
	 if (!empty($desktop)) {
    $updateValues[] = "desktop = '$desktop'";
  }
	 if (!empty($deskbot)) {
    $updateValues[] = "deskbot = '$deskbot'";
  }
	 if (!empty($deskextra)) {
    $updateValues[] = "deskextra = '$deskextra'";
  }

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_author = '$id_author'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в country
if (isset($_POST['country-btn'])) {
  $id_country = $_POST['id_country']; 
  $countryName = $_POST['countryName']; 
	

  $updateQuery = "UPDATE country SET ";
  $updateValues = array();

  if (!empty($id_country)) {
    $updateValues[] = "id_country = '$id_country'";
  }
	if (!empty($countryName)) {
    $updateValues[] = "countryName = '$countryName'";
  }
  

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_country = '$id_country'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в genre
if (isset($_POST['genre-btn'])) {
  $id_genre = $_POST['id_genre']; 
  $genreName = $_POST['genreName']; 
	

  $updateQuery = "UPDATE genre SET ";
  $updateValues = array();

  if (!empty($id_genre)) {
    $updateValues[] = "id_genre = '$id_genre'";
  }
	if (!empty($genreName)) {
    $updateValues[] = "genreName = '$genreName'";
  }
  

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_genre = '$id_genre'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в translator
if (isset($_POST['translator-btn'])) {
  $id_translator = $_POST['id_translator']; 
  $translatorName = $_POST['translatorName']; 
	

  $updateQuery = "UPDATE translator SET ";
  $updateValues = array();

  if (!empty($id_translator)) {
    $updateValues[] = "id_translator = '$id_translator'";
  }
	if (!empty($translatorName)) {
    $updateValues[] = "translatorName = '$translatorName'";
  }
  

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_translator = '$id_translator'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в sale
if (isset($_POST['sale-btn'])) {

  $id_sale = $_POST['id_sale']; 
  $saleText = $_POST['saleText']; 
	$saleFor = $_POST['saleFor'];
	$salePromo = $_POST['salePromo']; 
	$salePhoto = $_FILES["salePhoto"]["name"]; 


  $updateQuery = "UPDATE sale SET ";
  $updateValues = array();

  if (!empty($id_sale)) {
    $updateValues[] = "id_sale = '$id_sale'";
  }

	if (!empty($salePhoto)) {
    $updateValues[] = "photo = '$salePhoto'";
  }

	if (!empty($saleText)) {
    $updateValues[] = "saleText = '$saleText'";
  }

	if (!empty($saleFor)) {
    $updateValues[] = "saleFor = '$saleFor'";
  }

	if (!empty($salePromo)) {
    $updateValues[] = "salePromo = '$salePromo'";
  }
  

  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_sale = '$id_sale'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в news
if (isset($_POST['news-btn'])) {

  $id_news = $_POST['id_news']; 
	$news_photo = $_FILES["news_photo"]["name"]; 


  $updateQuery = "UPDATE news SET ";
  $updateValues = array();

  if (!empty($id_news)) {
    $updateValues[] = "id_news = '$id_news'";
  }

	if (!empty($news_photo)) {
    $updateValues[] = "photo = '$news_photo'";
  }


  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_news = '$id_news'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в exemplyar
if (isset($_POST['exemplyar-btn'])) {

  $id_exemplyar = $_POST['id_exemplyar'];  
	$exemplyarName = $_POST['exemplyarName'];  
	$id_book = $_POST['id_book'];  
	$amount = $_POST['amount'];  

  $updateQuery = "UPDATE exemplyar SET ";
  $updateValues = array();

  if (!empty($id_exemplyar)) {
    $updateValues[] = "id_exemplyar = '$id_exemplyar'";
  }

	if (!empty($exemplyarName)) {
    $updateValues[] = "exemplyarName = '$exemplyarName'";
  }

	if (!empty($id_book)) {
    $updateValues[] = "id_book = '$id_book'";
  }

	if (!empty($amount)) {
    $updateValues[] = "amount = '$amount'";
  }


  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_exemplyar = '$id_exemplyar'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}

// изменяем в achieve
if (isset($_POST['achieve-btn'])) {

  $id_achieve = $_POST['id_achieve'];  
	$id_author = $_POST['id_author']; 
	$title1 = $_POST['title1'];  
	$title2 = $_POST['title2'];  
	$title3 = $_POST['title3'];  
	$title4 = $_POST['title4']; 

  $updateQuery = "UPDATE achieve SET ";
  $updateValues = array();

  if (!empty($id_achieve)) {
    $updateValues[] = "id_achieve = '$id_achieve'";
  }

	if (!empty($id_author)) {
    $updateValues[] = "id_author = '$id_author'";
  }

	if (!empty($title1)) {
    $updateValues[] = "title1 = '$title1'";
  }

	if (!empty($title2)) {
    $updateValues[] = "title2 = '$title2'";
  }

	if (!empty($title3)) {
    $updateValues[] = "title3 = '$title3'";
  }

	if (!empty($title4)) {
    $updateValues[] = "title4 = '$title4'";
  }


  if (!empty($updateValues)) {
    $updateQuery .= implode(', ', $updateValues);
    $updateQuery .= " WHERE id_achieve = '$id_achieve'";

    $result = mysqli_query($db, $updateQuery);
    if ($result) {
      echo "<script>alert('Данные успешно изменены');history.go(-1);</script>";
    } else {
      echo "<script>alert('Ошибка изменения данных');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('Нет данных для изменения');history.go(-1);</script>";
  }
}
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
				<h2 class='form-add-title'>Изменить пользователя</h2>

				<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

					<label for="id_user">Id записи:</label><br>
    			<input class='form-add-input' type="text" id="id_user" name="id_user" ><br>

    			<label for="user-name">Имя:</label><br>
    			<input class='form-add-input' type="text" id="name" name="user-name" ><br>

    			<label for="user-surname">Фамилия:</label><br>
    			<input class='form-add-input' type="surname" id="surname" name="user-surname" ><br>

					<label for="user-otch">Отчество</label><br>
    			<input class='form-add-input' type="text" id="otch" name="user-otch" ><br>

    			<label for="user-email">Почта:</label><br>
    			<input class='form-add-input' type="text" id="email" name="user-email" ><br>

					<label for="user-login">Login:</label><br>
    			<input class='form-add-input' type="text" id="login" name="user-login" ><br>

    			<label for="user-password">Пароль:</label><br>
    			<input class='form-add-input' type="text" id="password" name="user-password" ><br>

    			<label for="user-role">Роль:</label><br>
    			<input class='form-add-input' type="number" id="role" name="user-role" ><br>

    			<input class='button' name='user-btn' type="submit" value="Изменить">
				</form>
			</div>

			<div class="add-forms-part">
				<h2 class='form-add-title'>Изменить книгу</h2>
				<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
			
				<label for="id_book">Id записи:</label><br>
    		<input class='form-add-input' type="text" id="id_book" name="id_book" ><br>

    		<label for="date_publish">Дата публикации:</label><br>
    		<input class='form-add-input' type="text" id="date_publish" name="date_publish" ><br>

    		<label for="id_author">ID автора:</label><br>
    		<input class='form-add-input' type="number" id="id_author" name="id_author" ><br>

    		<label for="id_genre">ID жанра:</label><br>
    		<input class='form-add-input' type="number" id="id_genre" name="id_genre" ><br>

    		<label for="book_cost">Цена:</label><br>
    		<input class='form-add-input' type="number" id="book_cost" name="book_cost" ><br>

				<label for="id_translator">ID Переводчика:</label><br>
    		<input class='form-add-input' type="number" id="id_translator" name="id_translator" ><br>

				<label for="book_name">Название: </label><br>
    		<input class='form-add-input' type="text" id="book_name" name="book_name" ><br>

				<label for="book_photo">Обложка: </label><br>
				<input class='form-add-input' type="file" id="book_photo" name="book_photo"><br>

				<label for="book_description">Описание: </label><br>
    		<input class='form-add-input' type="text" id="book_description" name="book_description" ><br>

    		<input class='button' name='book-btn' type="submit" value="Изменить книгу">
			</form>
		</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить автора</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_author">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_author" name="id_author" ><br>

			<label for="author_name">Имя Фамилия: </label><br>
    	<input class='form-add-input' type="text" id="author_name" name="author_name" ><br>

			<label for="id_country">ID Страны: </label><br>
    	<input class='form-add-input' type="text" id="id_country" name="id_country" ><br>

			<label for="smallPhoto">Маленькое фото:  </label><br>
    	<input class='form-add-input' type="file" id="smallPhoto" name="smallPhoto" ><br>

			<label for="mainPhoto">Главное фото: </label><br>
    	<input class='form-add-input' type="file" id="mainPhoto" name="mainPhoto" ><br>

			<label for="extraPhoto">Дополнительное фото: </label><br>
    	<input class='form-add-input' type="file" id="extraPhoto" name="extraPhoto" ><br>

			<label for="dateb">Дата рождения: </label><br>
    	<input class='form-add-input' type="text" id="dateb" name="dateb" ><br>

			<label for="desktop">Верхнее описание: </label><br>
    	<input class='form-add-input' type="text" id="desktop" name="desktop" ><br>
		 
			<label for="deskbot">Нижнее описание: </label><br>
    	<input class='form-add-input' type="text" id="deskbot" name="deskbot" ><br>

			<label for="deskextra">Дополнительное описание: </label><br>
    	<input class='form-add-input' type="text" id="deskextra" name="deskextra" ><br>

    	<input class='button' name='author-btn' type="submit" value="Изменить автора">
		</form>
	</div>

	<div class="add-forms-part">
		<h2	h2 class='form-add-title'>Изменить страну</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label for="id_country">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_country" name="id_country" ><br>

    	<label for="countryName">Страна:</label><br>
    	<input class='form-add-input' type="text" id="countryName" name="countryName" ><br>
    	<input class='button' name='country-btn' type="submit" value="Изменить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить жанр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" 	method="post">

			<label for="id_genre">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_genre" name="id_genre" ><br>

    	<label for="genreName">Жанр</label><br>
    	<input class='form-add-input' type="text" id="genreName" name="genreName" ><br>

    	<input class='button' name='genre-btn' type="submit" value="Изменить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить переводчик</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<label for="id_translator">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_translator" name="id_translator" ><br>

    	<label for="translatorName">Переводчик:</label><br>
    	<input class='form-add-input' type="text" id="translatorName" name="translatorName" ><br>

    	<input class='button' name='translator-btn' type="submit" value="Изменить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить акцию</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

		<label for="id_sale">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_sale" name="id_sale" ><br>

    	<label for="saleText">Текст акции:</label><br>
    	<input class='form-add-input' type="text" id="saleText" name="saleText" ><br>

    	<label for="saleFor">Для кого акция:</label><br>
    	<input class='form-add-input' type="text" id="saleFor" name="saleFor" ><br>

    	<label for="salePromo">Купон:</label><br>
    	<input class='form-add-input' type="text" id="salePromo" name="salePromo" ><br>

			<label for="salePhoto">Обложка: </label><br>
    	<input class='form-add-input' type="file" id="salePhoto" name="salePhoto" ><br>

    	<input class='button' name='sale-btn' type="submit" value="Изменить акцию">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить новость</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_news">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_news" name="id_news" ><br>

			<label for="news_photo">Обложка: </label><br>
    	<input class='form-add-input' type="file" id="news_photo" name="news_photo" ><br>

    	<input class='button' name='news-btn' type="submit" value="Изменить новость">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Изменить экземпляр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="id_exemplyar">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_exemplyar" name="id_exemplyar" ><br>

			<label for="exemplyarName">Название: </label><br>
    	<input class='form-add-input' type="text" id="exemplyarName" name="exemplyarName"><br>

			<label for="id_book">ID Книги: </label><br>
    	<input class='form-add-input' type="text" id="id_book" name="id_book" ><br>

			<label for="amount">Количество: </label><br>
    	<input class='form-add-input' type="number" id="amount" name="amount" ><br>

    <input class='button' name='exemplyar-btn' type="submit" value="Изменить экземпляр">
		</form>
	</div>


    <div class="add-forms-part">
		<h2 class='form-add-title'>Изменить достижение</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<label for="id_achieve">Id записи:</label><br>
    	<input class='form-add-input' type="text" id="id_achieve" name="id_achieve" ><br>

    	<label for="title1">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title1" name="title1" ><br>

        <label for="title2">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title2" name="title2" ><br>

        <label for="title3">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title3" name="title3" ><br>

        <label for="title4">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title4" name="title4" ><br>

        <label for="id_author">ID Автора: </label><br>
    	<input class='form-add-input' type="text" id="id_author" name="id_author" ><br>

    	<input class='button' name='achieve-btn' type="submit" value="Изменить">
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
