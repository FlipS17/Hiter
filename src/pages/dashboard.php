<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../scss/style.css" />
    <link rel="icon" type="image/png" href="/src/img/favicon.png" />
    <title>График данных</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header class="header">
        <div class="header__container container">
            <a href="index.php" class="header__logo">
                <img src="../img/mainpage/logo.svg" />
            </a>
            <ul class="header__nav-list">
                <a href="/src/pages/catalog.php" class="header__nav-list-link">
                    <li class="header__nav-list-item">Книги</li>
                </a>
                <a href="/src/pages/all-author.php" class="header__nav-list-link">
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
                <a href="/src/pages/account.php"><img src="../../src/img/mainpage/account.svg" /></a>
                <a href="/src/pages/cart.php"><img src="../../src/img/mainpage/cart.svg" /></a>
            </div>
            <div class="header__burger">
                <span class="header__burger-bar"></span>
                <span class="header__burger-bar"></span>
                <span class="header__burger-bar"></span>
            </div>
            <nav class="header__nav-mobile">
                <ul class="header__nav-mobile-menu">
                    <li class="header__nav-mobile-menu-item">
                        <a href="/src/pages/catalog.php" class="header__nav-mobile-menu-link">Книги</a>
                    </li>
                    <li class="header__nav-mobile-menu-item">
                        <a href="/src/pages/all-author.php" class="header__nav-mobile-menu-link">Авторы</a>
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

    <section class="dashboard">
        <h2 class="dashboard__title">Dashboard</h2>
        <div class="dashboard__container">
            <div class="dashboard__container-cards">
                <div class="dashboard__container-cards-info">
                    <div class="dashboard__container-cards-info-top">
                        <img class="dashboard__container-cards-info-img" src="../img/dashboard/user.png">
                        <p class="dashboard__container-cards-info-text">Пользователи</p>
                    </div>
                    <p class="dashboard__container-cards-info-text"><b>5</b></p>
                </div>

                <div class="dashboard__container-cards-info">
                    <div class="dashboard__container-cards-info-top">
                        <img class="dashboard__container-cards-info-img" src="../img/dashboard/author.png">
                        <p class="dashboard__container-cards-info-text">Авторы</p>
                    </div>
                    <p class="dashboard__container-cards-info-text"><b>5</b></p>
                </div>

				<div class="dashboard__container-cards-info">
                    <div class="dashboard__container-cards-info-top">
                        <img class="dashboard__container-cards-info-img" src="../img/dashboard/book.png">
                        <p class="dashboard__container-cards-info-text">Продано книг</p>
                    </div>
                    <p class="dashboard__container-cards-info-text"><b>5</b></p>
                </div>

				<div class="dashboard__container-cards-info">
                    <div class="dashboard__container-cards-info-top">
                        <img class="dashboard__container-cards-info-img" src="../img/dashboard/total.png">
                        <p class="dashboard__container-cards-info-text">Выручка</p>
                    </div>
                    <p class="dashboard__container-cards-info-text"><b>5</b></p>
                </div>

            <canvas id="dailyRevenueChart" style="max-width: 400px; margin: 20px auto;"></canvas>
            <canvas id="monthlyRevenueChart" style="max-width: 400px; margin: 20px auto;"></canvas>
            <canvas id="yearlyRevenueChart" style="max-width: 400px; margin: 20px auto;"></canvas>
        </div>
    </section>

    <?php
	$db = mysqli_connect('localhost','root', '', 'Hiter' );

    if ($db == false){
        echo 'Ошибка подключения';
        exit;
    }

    // // Запрос данных
    // $result = $db->query("SELECT revenue_day_1, revenue_day_2, revenue_day_3, revenue_month_1, revenue_month_2, revenue_month_3, revenue_year_1, revenue_year_2, revenue_year_3 FROM revenue_data");
    // $data = $result->fetch_assoc();

    // $dailyRevenueData = json_encode([$data['revenue_day_1'], $data['revenue_day_2'], $data['revenue_day_3']]);
    // $monthlyRevenueData = json_encode([$data['revenue_month_1'], $data['revenue_month_2'], $data['revenue_month_3']]);
    // $yearlyRevenueData = json_encode([$data['revenue_year_1'], $data['revenue_year_2'], $data['revenue_year_3']]);
    // ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dailyRevenueData = <?php echo $dailyRevenueData; ?>;
        const monthlyRevenueData = <?php echo $monthlyRevenueData; ?>;
        const yearlyRevenueData = <?php echo $yearlyRevenueData; ?>;

        const dailyRevenueChart = new Chart(document.getElementById('dailyRevenueChart'), {
            type: 'pie',
            data: {
                labels: ['Выручка 1', 'Выручка 2', 'Выручка 3'],
                datasets: [{
                    label: 'Выручка за день',
                    data: dailyRevenueData,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        const monthlyRevenueChart = new Chart(document.getElementById('monthlyRevenueChart'), {
            type: 'pie',
            data: {
                labels: ['Выручка 1', 'Выручка 2', 'Выручка 3'],
                datasets: [{
                    label: 'Выручка за месяц',
                    data: monthlyRevenueData,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        const yearlyRevenueChart = new Chart(document.getElementById('yearlyRevenueChart'), {
            type: 'pie',
            data: {
                labels: ['Выручка 1', 'Выручка 2', 'Выручка 3'],
                datasets: [{
                    label: 'Выручка за год',
                    data: yearlyRevenueData,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>