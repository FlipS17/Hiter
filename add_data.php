<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'Hiter');

// Проверяем, есть ли ошибки подключения
if ($db == false) {
    echo 'Ошибка подключения';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Добавление нового пользователя
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['otch']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['role'])) {

        // Даем значение для данных
        $name = $db->real_escape_string($_POST['name']);
        $surname = $db->real_escape_string($_POST['surname']);
        $otch = $db->real_escape_string($_POST['otch']);
        $email = $db->real_escape_string($_POST['email']);
        $login = $db->real_escape_string($_POST['login']);
        $password = $db->real_escape_string($_POST['password']);
        $role = intval($_POST['role']);

        // Проверка на заполнение всех полей
        if (!empty($name) &&!empty($surname) &&!empty($otch) &&!empty($email) &&!empty($login) &&!empty($password)) {

            // Проверка на существующую почту
            $check_sql = "SELECT * FROM user WHERE email='$email'";
            $check_result = $db->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo 'Пользователь с таким email уже существует';
            } else {
                // Проверка на существующего пользователя с таким Login
                $check_sql_login = "SELECT * FROM user WHERE login='$login'";
                $check_result_login = $db->query($check_sql_login);

                if ($check_result_login->num_rows > 0) {
                    echo 'Пользователь с таким Login уже существует';
                } else {
                    // Проверка на правильное заполнение почты
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Неправильный формат электронной почты';
                        exit;
                    } else {
                        $insert_sql = "INSERT INTO user (surname, name, otch, email, login, password, role) VALUES (?,?,?,?,?,?,?)";
                        $stmt = $db->prepare($insert_sql);
                        $stmt->bind_param("ssssssi", $surname, $name, $otch, $email, $login, $password, $role);

                        if ($stmt->execute()) {
                            echo 'Данные пользователя успешно добавлены';
														header('location:add_data.php');
                        } else {
                            echo 'Ошибка добавления данных пользователя: '. $db->error;
                        }
                    }
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля формы для пользователя.';
        }
    }

		//добавление новой страны
    if (isset($_POST['countryName'])) {
        $countryName = $db->real_escape_string($_POST['countryName']);
        
        if (!empty($countryName)) {
            $check_sql = "SELECT * FROM country WHERE countryName='$countryName'";
            $check_result = $db->query($check_sql);
						if ($check_result->num_rows > 0) {
                echo 'Такая страна уже есть в базе данных';
            } else {
                $insert_sql = "INSERT INTO country (countryName) VALUES (?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("s", $countryName);
                
                if ($stmt->execute()) {
                    echo 'Страна успешно добавлена';
										header('location:add_data.php');
                } else {
                    echo 'Ошибка добавления страны: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля';
        }
    }

		// //добавление нового жанра
    if (isset($_POST['genreName'])) {
        $genreName = $db->real_escape_string($_POST['genreName']);
        
        if (!empty($genreName)) {
            $check_genre = "SELECT * FROM genre WHERE genreName='$genreName'";
            $check_result = $db->query($check_genre);
						if ($check_result->num_rows > 0) {
                echo 'Такой жанр уже есть в базе данных';
            } else {
                $insert_sql = "INSERT INTO genre (genreName) VALUES (?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("s", $genreName);
                
                if ($stmt->execute()) {
                    echo 'Жанр успешно добавлен';
										header('location:add_data.php');
                } else {
                    echo 'Ошибка добавления жанра: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля';
        }
    }

// Добавление новой книги       
     if (isset($_POST['date_publish']) && isset($_POST['id_author']) && isset($_POST['id_genre']) && isset($_POST['cost']) && isset($_POST['id_translator']) && isset($_POST['name']) && isset($_FILES['photo']) && isset($_POST['description'])) {
    $date_publish = $db->real_escape_string($_POST['date_publish']);
    $id_author = $db->real_escape_string($_POST['id_author']);
    $id_genre = $db->real_escape_string($_POST['id_genre']);
    $cost = $db->real_escape_string($_POST['cost']);
    $id_translator = $db->real_escape_string($_POST['id_translator']);
    $name = $db->real_escape_string($_POST['name']);
    $description = $db->real_escape_string($_POST['description']);
    $photo_file = $_FILES['photo'];

    if (!empty($date_publish) &&!empty($id_author) &&!empty($id_genre) &&!empty($cost) &&!empty($id_translator) &&!empty($name) &&!empty($description) &&!empty($photo_file)) 
        if ($_FILES['photo']['error'] == 0) {
            $photo_filename = basename($photo_file['name']);
            $photo_filepath = './src/img/book/'. $photo_filename;
            $photo_filetype = strtolower(pathinfo($photo_filepath, PATHINFO_EXTENSION));

            if ($photo_filetype!= 'jpg' && $photo_filetype!= 'png' && $photo_filetype!= 'jpeg') {
                echo 'Недопустимый тип файла. Только JPG, JPEG и PNG допустимы.';
            } else {
                if (move_uploaded_file($photo_file['tmp_name'], $photo_filepath)) {
                    $insert_book_sql = "INSERT INTO book (id_author, id_genre, date_publish, cost, id_translator, name, photo, description) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt = $db->prepare($insert_book_sql);
                    $stmt->bind_param("iisiisss", $id_author, $id_genre, $date_publish, $cost, $id_translator, $name, $photo_filename, $description);

                    if ($stmt->execute()) {
                        echo 'Новая книга успешно добавлена';
                        header("location:./add_data.php");
                    } else {
                        echo 'Ошибка добавления книги: '. $db->error;
                    }
                } else {
                    echo 'Ошибка загрузки файла';
                }
            }
        } else {
            echo 'Ошибка загрузки файла: '. $_FILES['photo']['error'];
        }
    } else {
        echo 'Пожалуйста, заполните все поля поля';
    }

		//добавление нового Переводчика
    if (isset($_POST['translatorName'])) {
        $translatorName = $db->real_escape_string($_POST['translatorName']);
        
        if (!empty($translatorName)) {
            $check_sql = "SELECT * FROM translator WHERE translatorName='$translatorName'";
            $check_result = $db->query($check_sql);
						if ($check_result->num_rows > 0) {
                echo 'Такой переводчик уже есть в базе данных';
            } else {
                $insert_sql = "INSERT INTO translator (translatorName) VALUES (?)";
                $stmt = $db->prepare($insert_sql);
                $stmt->bind_param("s", $translatorName);
                
                if ($stmt->execute()) {
                    echo 'Переводчик успешно добавлен';
										header('location:add_data.php');
                } else {
                    echo 'Ошибка добавления переводчика: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля';
        }
    }

		// Добавление новой акции       
     if (isset($_POST['saleText']) && isset($_POST['saleFor']) && isset($_POST['salePromo']) && isset($_FILES['photo'])) {

    $saleText = $db->real_escape_string($_POST['saleText']);
    $saleFor = $db->real_escape_string($_POST['saleFor']);
    $salePromo = $db->real_escape_string($_POST['salePromo']);
    
    $photo_file = $_FILES['photo'];

    if (!empty($saleText) &&!empty($saleFor) &&!empty($salePromo) &&!empty($photo_file)) 

        if ($_FILES['photo']['error'] == 0) {
            $photo_filename = basename($photo_file['name']);
            $photo_filepath = './src/img/sales/'. $photo_filename;
            $photo_filetype = strtolower(pathinfo($photo_filepath, PATHINFO_EXTENSION));

            if ($photo_filetype!= 'jpg' && $photo_filetype!= 'png' && $photo_filetype!= 'jpeg') {
                echo 'Недопустимый тип файла. Только JPG, JPEG и PNG допустимы.';
            } else {
                if (move_uploaded_file($photo_file['tmp_name'], $photo_filepath)) {
                    $insert_sale_sql = "INSERT INTO sale (saleFor, salePromo, saleText, photo) VALUES (?,?,?,?)";
                    $stmt = $db->prepare($insert_sale_sql);
                    $stmt->bind_param("ssss", $saleFor, $salePromo, $saleText, $photo_filename);

                    if ($stmt->execute()) {
                        echo 'Новая акция успешно добавлена';
                        header("location:./add_data.php");
                    } else {
                        echo 'Ошибка добавления акции: '. $db->error;
                    }
                } else {
                    echo 'Ошибка загрузки файла';
                }
            }
        } else {
            echo 'Ошибка загрузки файла: '. $_FILES['photo']['error'];
        }
    } else {
        echo 'Пожалуйста, заполните все поля поля';
    }

		// Добавление новой новости      
     if (isset($_FILES['photo'])) {
    
    $photo_file = $_FILES['photo'];

    if (!empty($photo_file)) 

        if ($_FILES['photo']['error'] == 0) {
            $photo_filename = basename($photo_file['name']);
            $photo_filepath = './src/img/mainpage/'. $photo_filename;
            $photo_filetype = strtolower(pathinfo($photo_filepath, PATHINFO_EXTENSION));

            if ($photo_filetype!= 'jpg' && $photo_filetype!= 'png' && $photo_filetype!= 'jpeg') {
                echo 'Недопустимый тип файла. Только JPG, JPEG и PNG допустимы.';
            } else {
                if (move_uploaded_file($photo_file['tmp_name'], $photo_filepath)) {
                    $insert_news_sql = "INSERT INTO news (photo) VALUES (?)";
                    $stmt = $db->prepare($insert_news_sql);
                    $stmt->bind_param("s", $photo_filename);

                    if ($stmt->execute()) {
                        echo 'Новая акция успешно добавлена';
                        header("location:./add_data.php");
                    } else {
                        echo 'Ошибка добавления акции: '. $db->error;
                    }
                } else {
                    echo 'Ошибка загрузки файла';
                }
            }
        } else {
            echo 'Ошибка загрузки файла: '. $_FILES['photo']['error'];
        }
    } else {
        echo 'Пожалуйста, заполните все поля поля';
    }

		// Добавление нового экземплфяра
    if (isset($_POST['exemplyarName']) && isset($_POST['amount']) && isset($_POST['id_book'])) {

        $exemplyarName = $db->real_escape_string($_POST['exemplyarName']);
        $amount = isset($_POST['amount']); 

        $id_book = $_POST["id_book"];
      

        if (!empty($exemplyarName) && !empty($amount) && !empty($id_book)) {

            $check_tour_sql = "SELECT * FROM exemplyar WHERE exemplyarName='$exemplyarName'";
            $check_tour_result = $db->query($check_tour_sql);

            if ($check_tour_result->num_rows > 0) {
                echo 'Экземпляр с таким названием уже существует';
            } else {
                $insert_tour_sql = "INSERT INTO exemplyar (exemplyarName, amount, id_book) VALUES (?, ?, ?)";
                $stmt = $db->prepare($insert_tour_sql);
                $stmt->bind_param("sii", $exemplyarName, $amount, $id_book);
                
                if ($stmt->execute()) {
                    echo 'Новый Экземпляр успешно добавлен';
                } else {
                    echo 'Ошибка добавления Экземпляра: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля .';
        }
    }

    // Добавление новых достижений
    if (isset($_POST['title1']) && isset($_POST['title2']) && isset($_POST['title3']) && isset($_POST['title4']) && isset($_POST['id_author'])) {

        $title1 = $db->real_escape_string($_POST['title1']);
        $title2 = $db->real_escape_string($_POST['title2']);
        $title3 = $db->real_escape_string($_POST['title3']);
        $title4 = $db->real_escape_string($_POST['title4']);
        $id_author = $db->real_escape_string($_POST['id_author']);
        

        if (!empty($title1) && !empty($title2) && !empty($title3) && !empty($title4) && !empty($id_author)) {

            $check_author_sql = "SELECT * FROM achieve WHERE id_author='$id_author'";
            $check_author_result = $db->query($check_author_sql);

            if ($check_author_result->num_rows > 0) {
                echo 'Автор с таким названием уже существует';
            } else {
                $insert_achieve_sql = "INSERT INTO achieve (id_author, title1, title2, title3, title4) VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($insert_achieve_sql);

                $stmt->bind_param("issss", $id_author, $title1, $title2, $title3, $title4);
                
                if ($stmt->execute()) {
                    echo 'Новые достижения успешно добавлены';
                } else {
                    echo 'Ошибка добавления достижений: '. $db->error;
                }
            }
        } else {
            echo 'Пожалуйста, заполните все поля .';
        }
    }
            
		// Добавление нового автора    
     if (isset($_FILES['smallPhoto']) && isset($_FILES['mainPhoto']) && isset($_FILES['extraPhoto']) && isset($_POST['name']) && isset($_POST['dateb']) && isset($_POST['id_country']) && isset($_POST['desktop']) && isset($_POST['deskbot']) && isset($_POST['deskextra'])) {
    
			$id_country = $_POST["id_country"];


			$name = $db->real_escape_string($_POST['name']);
			$desktop = $db->real_escape_string($_POST['desktop']);
			$deskbot = $db->real_escape_string($_POST['deskbot']);
			$deskextra = $db->real_escape_string($_POST['deskextra']);
			$dateb = $db->real_escape_string($_POST['dateb']);


    $photo_file1 = $_FILES['smallPhoto'];
		$photo_file2 = $_FILES['mainPhoto'];
		$photo_file3 = $_FILES['extraPhoto'];

    if (!empty($photo_file1) && !empty($photo_file2) && !empty($photo_file3) && !empty($photo_file2) && !empty($name)  && !empty($desktop) && !empty($deskbot) && !empty($deskextra) && !empty($dateb)) 

        if ($_FILES['smallPhoto']['error'] == 0 && $_FILES['mainPhoto']['error'] == 0 && $_FILES['extraPhoto']['error'] == 0) {

            $photo_filename1 = basename($photo_file1['name']);
            $photo_filepath1 = './src/img/author/'. $photo_filename1;
            $photo_filetype = strtolower(pathinfo($photo_filepath1, PATHINFO_EXTENSION));

						$photo_filename2 = basename($photo_file2['name']);
            $photo_filepath2 = './src/img/author/'. $photo_filename2;
            $photo_filetype = strtolower(pathinfo($photo_filepath2, PATHINFO_EXTENSION));

						$photo_filename3 = basename($photo_file3['name']);
            $photo_filepath3 = './src/img/author/'. $photo_filename3;
            $photo_filetype = strtolower(pathinfo($photo_filepath3, PATHINFO_EXTENSION));

            if ($photo_filetype!= 'jpg' && $photo_filetype!= 'png' && $photo_filetype!= 'jpeg') {
                echo 'Недопустимый тип файла. Только JPG, JPEG и PNG допустимы.';
            } else {
                if (move_uploaded_file($photo_file1['tmp_name'], $photo_filepath1) && move_uploaded_file($photo_file2['tmp_name'], $photo_filepath2) && move_uploaded_file($photo_file3['tmp_name'], $photo_filepath3)) {

                    $insert_news_sql = "INSERT INTO author (name, dateb, id_country, smallPhoto, mainPhoto, extraPhoto, desktop, deskbot, deskextra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $db->prepare($insert_news_sql);
                    $stmt->bind_param("ssissssss", $name, $dateb, $id_country, $photo_filename1, $photo_filename2, $photo_filename3, $desktop, $deskbot, $deskextra );

                    if ($stmt->execute()) {
    								echo 'Автор успешно добавлен';
										header("location:./add_data.php");
										} else {
    								echo 'Ошибка добавления автора: '. $db->error;
										}
                } else {
                    echo 'Ошибка загрузки файла';
                }
            }
        } else {
            echo 'Ошибка загрузки файла: '. $_FILES['photo']['error'];
        }
    } else {
        echo 'Пожалуйста, заполните все поля поля';
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
		<h2 class='form-add-title'>Добавить пользователя</h2>

		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    	<label for="name">Имя:</label><br>
    	<input class='form-add-input' type="text" id="name" name="name" required><br>
    	<label for="surname">Фамилия:</label><br>
    	<input class='form-add-input' type="surname" id="surname" name="surname" required><br>
			<label for="otch">Отчество</label><br>
    	<input class='form-add-input' type="text" id="otch" name="otch" required><br>
    	<label for="email">Почта:</label><br>
    	<input class='form-add-input' type="text" id="email" name="email" required><br>
			<label for="login">Login:</label><br>
    	<input class='form-add-input' type="text" id="login" name="login" required><br>
    	<label for="password">Пароль:</label><br>
    	<input class='form-add-input' type="text" id="password" name="password" required><br>
    	<label for="role">Роль:</label><br>
    	<input class='form-add-input' type="number" id="role" name="role" required><br>
    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить книгу</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

    <label for="date_publish">Дата публикации:</label><br>
    <input class='form-add-input' type="text" id="date_publish" name="date_publish" required><br>

    <label for="id_author">ID автора:</label><br>
    <input class='form-add-input' type="number" id="id_author" name="id_author" required><br>

    <label for="id_genre">ID жанра:</label><br>
    <input class='form-add-input' type="number" id="id_genre" name="id_genre" required><br>

    <label for="cost">Цена:</label><br>
    <input class='form-add-input' type="number" id="cost" name="cost" required><br>

		<label for="id_translator">ID Переводчика:</label><br>
    <input class='form-add-input' type="number" id="id_translator" name="id_translator" required><br>

		<label for="name">Название: </label><br>
    <input class='form-add-input' type="text" id="name" name="name" required><br>

		<label for="photo">Обложка: </label><br>
    <input class='form-add-input' type="file" id="photo" name="photo" required><br>

		<label for="description">Описание: </label><br>
    <input class='form-add-input' type="text" id="description" name="description" required><br>

    <input class='button' type="submit" value="Добавить книгу">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить автора</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="name">Название: </label><br>
    	<input class='form-add-input' type="text" id="name" name="name" required><br>

			<label for="id_country">ID Страны: </label><br>
    	<input class='form-add-input' type="text" id="id_country" name="id_country" required><br>

			<label for="smallPhoto">Маленькое фото:  </label><br>
    	<input class='form-add-input' type="file" id="smallPhoto" name="smallPhoto" required><br>

			<label for="mainPhoto">Главное фото: </label><br>
    	<input class='form-add-input' type="file" id="mainPhoto" name="mainPhoto" required><br>

			<label for="extraPhoto">Дополнительное фото: </label><br>
    	<input class='form-add-input' type="file" id="extraPhoto" name="extraPhoto" required><br>

			<label for="dateb">Дата рождения: </label><br>
    	<input class='form-add-input' type="text" id="dateb" name="dateb" required><br>

			<label for="desktop">Верхнее описание: </label><br>
    	<input class='form-add-input' type="text" id="desktop" name="desktop" required><br>
		 
			<label for="deskbot">Нижнее описание: </label><br>
    	<input class='form-add-input' type="text" id="deskbot" name="deskbot" required><br>

			<label for="deskextra">Дополнительное описание: </label><br>
    	<input class='form-add-input' type="text" id="deskextra" name="deskextra" required><br>

    	<input class='button' type="submit" value="Добавить автора">
		</form>
	</div>

	<div class="add-forms-part">
		<h2	h2 class='form-add-title'>Добавить страну</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    	<label for="countryName">Страна:</label><br>
    	<input class='form-add-input' type="text" id="countryName" name="countryName" required><br>
    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить жанр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" 	method="post">
    	<label for="genreName">Жанр</label><br>
    	<input class='form-add-input' type="text" id="genreName" name="genreName" required><br>
    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить переводчик</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    	<label for="translatorName">Переводчик:</label><br>
    	<input class='form-add-input' type="text" id="translatorName" name="translatorName" required><br>
    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить акцию</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

    	<label for="saleText">Текст акции:</label><br>
    	<input class='form-add-input' type="text" id="saleText" name="saleText" required><br>

    	<label for="saleFor">Для кого акция:</label><br>
    	<input class='form-add-input' type="text" id="saleFor" name="saleFor" required><br>

    	<label for="salePromo">Купон:</label><br>
    	<input class='form-add-input' type="text" id="salePromo" name="salePromo" required><br>

			<label for="photo">Обложка: </label><br>
    	<input class='form-add-input' type="file" id="photo" name="photo" required><br>

    	<input class='button' type="submit" value="Добавить акцию">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить новость</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="photo">Обложка: </label><br>
    	<input class='form-add-input' type="file" id="photo" name="photo" required><br>

    	<input class='button' type="submit" value="Добавить новость">
		</form>
	</div>

	<div class="add-forms-part">
		<h2 class='form-add-title'>Добавить экземпляр</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

			<label for="exemplyarName">Название: </label><br>
    	<input class='form-add-input' type="text" id="exemplyarName" name="exemplyarName" required><br>

			<label for="id_book">ID Автора: </label><br>
    	<input class='form-add-input' type="text" id="id_book" name="id_book" required><br>

			<label for="amount">Количесвто: </label><br>
    	<input class='form-add-input' type="number" id="amount" name="amount" required><br>

    <input class='button' type="submit" value="Добавить экземпляр">
		</form>
	</div>


    <div class="add-forms-part">
		<h2 class='form-add-title'>Добавить достижение</h2>
		<form class='form-add' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    	<label for="title1">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title1" name="title1" required><br>

        <label for="title2">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title2" name="title2" required><br>

        <label for="title3">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title3" name="title3" required><br>

        <label for="title4">Достижение:</label><br>
    	<input class='form-add-input' type="text" id="title4" name="title4" required><br>

        <label for="id_author">ID Автора: </label><br>
    	<input class='form-add-input' type="text" id="id_author" name="id_author" required><br>

    	<input class='button' type="submit" value="Добавить">
		</form>
	</div>
	

</div>

<footer class="footer">
			<div class="footer__container">
				<div class="footer__nav">
					<a href="/index.php"><img src="./src/img/mainpage/logo.svg" /></a>
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








