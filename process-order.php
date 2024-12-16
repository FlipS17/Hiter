<?php
session_start();

// Include the database connection file
require_once 'db_connection.php'; // Ensure this path is correct

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован']);
    exit;
}

$userId = $_SESSION['id_user']; // Получаем ID пользователя из сессии

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true); // Получаем данные о корзине

    // Отладочная информация
    file_put_contents('debug.log', print_r($input, true)); // Записываем данные в файл для отладки

    // Проверяем, есть ли товары в корзине
    if (isset($input['cart']) && !empty($input['cart'])) {
        $cart = $input['cart'];

        try {
            foreach ($cart as $item) {
                // Проверяем наличие необходимых данных
                if (!isset($item['id']) || !isset($item['amount']) || !isset($item['total_price'])) {
                    echo json_encode(['success' => false, 'message' => 'Некоторые товары не имеют необходимых данных']);
                    exit;
                }

                $bookId = $item['id']; // ID книги
                $amount = $item['amount']; // Количество
                $totalPrice = $item['total_price']; // Общая стоимость

                // Добавляем новую запись в базу данных для каждого товара
                $stmt = $pdo->prepare("
                    INSERT INTO userOrder (id_user, id_book, amount, total_price, status)
                    VALUES (?, ?, ?, ?, ?)
                ");

                $status = 'Ожидает оформления'; // Устанавливаем статус
                $stmt->execute([$userId, $bookId, $amount, $totalPrice, $status]);
            }

            // Возвращаем успешный ответ
            echo json_encode(['success' => true]);

        } catch (Exception $e) {
            // Обработка ошибок
            echo json_encode(['success' => false, 'message' => 'Ошибка при оформлении заказа: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Корзина пуста']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
}
?>
