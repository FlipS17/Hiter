<?php
session_start();
include 'db_connection.php'; // Подключение к базе данных

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
                $bookId = $item['id']; // ID книги
                $amount = $item['quantity']; // Количество
                $totalPrice = $item['cost'] * $amount; // Общая стоимость
                
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
