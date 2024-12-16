// Получаем данные о товарах из localStorage
const cart = JSON.parse(localStorage.getItem('cart')) || []

// Массив с промокодами и скидками
const promoCodes = [
	{ code: 'YOUA12', discount: 12 },
	{ code: 'FIRST15', discount: 15 },
	{ code: 'BECNA20', discount: 20 },
]

let discount = 0 // Переменная для хранения скидки

function renderCart() {
	const cartProductsContainer = document.querySelector('.cart__inner-products')
	const emptyMessage = document.querySelector('.cart__empty-message')
	const totalAmountElement = document.querySelector(
		'.cart__inner-aside-part-amount'
	)
	const totalCostElement = document.querySelector(
		'.cart__inner-aside-part-cost-number'
	)
	const totalItemsElement = document.querySelector(
		'.cart__inner-aside-part-total-number'
	)
	const promoCodeInput = document.getElementById('promo-code-input')
	const applyPromoCodeButton = document.getElementById('apply-promo-code')
	const discountMessage = document.querySelector('.discount-message')

	cartProductsContainer.innerHTML = ''

	let totalAmount = 0
	let totalCost = 0

	if (cart.length === 0) {
		emptyMessage.style.display = 'block'
		totalAmountElement.innerText = '0'
		totalCostElement.innerText = '0 ₽'
		totalItemsElement.innerText = '0'
	} else {
		emptyMessage.style.display = 'none'

		cart.forEach(item => {
			const productElement = document.createElement('div')
			productElement.classList.add('cart__inner-product')
			productElement.innerHTML = `
                <div>${item.name}</div>
                <div>${item.author}</div>
                <div>${item.cost} ₽</div>
                <div>${item.quantity}</div>
                <button class="remove" data-id="${item.id}">Удалить</button>
            `
			cartProductsContainer.appendChild(productElement)

			totalAmount += item.quantity
			totalCost += item.cost * item.quantity
		})

		totalAmountElement.innerText = totalAmount
		totalCostElement.innerText = `${totalCost} ₽`
		totalItemsElement.innerText = `${totalAmount} товаров`

		// Обработка удаления товаров из корзины
		document.querySelectorAll('.remove').forEach(button => {
			button.addEventListener('click', e => {
				const idToRemove = e.target.dataset.id
				const updatedCart = cart.filter(item => item.id !== idToRemove)
				localStorage.setItem('cart', JSON.stringify(updatedCart))
				renderCart()
			})
		})
	}

	// Применение промокода
	applyPromoCodeButton.addEventListener('click', () => {
		const promoCodeValue = promoCodeInput.value.trim()
		const promoCode = promoCodes.find(code => code.code === promoCodeValue)

		if (promoCode) {
			discount = promoCode.discount
			discountMessage.innerText = `Скидка ${discount}% применена!`
			const discountedPrice = totalCost - totalCost * (discount / 100)
			totalCostElement.innerText = `${discountedPrice.toFixed(2)} ₽`
		} else {
			discountMessage.innerText = 'Неверный промокод.'
		}
	})
}

// Вызов функции для отображения корзины при загрузке страницы
renderCart()

function renderCart() {
	const cartProductsContainer = document.querySelector('.cart__inner-products')
	const emptyMessage = document.querySelector('.cart__empty-message')
	const totalAmountElement = document.querySelector(
		'.cart__inner-aside-part-amount'
	)
	const totalCostElement = document.querySelector(
		'.cart__inner-aside-part-cost-number'
	)
	const totalItemsElement = document.querySelector(
		'.cart__inner-aside-part-total-number'
	)
	const promoCodeInput = document.getElementById('promo-code-input')
	const applyPromoCodeButton = document.getElementById('apply-promo-code')
	const discountMessage = document.querySelector('.discount-message')

	cartProductsContainer.innerHTML = ''
	let totalAmount = 0
	let totalCost = 0

	if (cart.length === 0) {
		emptyMessage.style.display = 'block'
	} else {
		emptyMessage.style.display = 'none'
		cart.forEach((item, index) => {
			const productElement = document.createElement('div')
			productElement.classList.add('cart__inner-product')
			productElement.innerHTML = `
                <img class='cart__inner-product-img' src='/src/img/book/${item.photo}'>
                <div class='cart__inner-product-info'>
                    <p class='cart__inner-product-info-text'>${item.name}</p>
                    <p class='cart__inner-product-info-text'>${item.author}</p>
                    <p class='cart__inner-product-info-text colored'>${item.cost} ₽</p>
                </div>
                <div class='cart__inner-product-move'>
                    <div class='cart__inner-product-move-count'>
                        <button class='cart__inner-product-move-count-more'>+</button>
                        <p class='cart__inner-product-move-count-number'>${item.quantity}</p>
                        <button class='cart__inner-product-move-count-less'>-</button>
                    </div>
                    <div class='cart__inner-product-move-delete'>
                        <img src='/src/img/cart/Delete.png'>
                        <p class='cart__inner-product-move-delete-text'>Удалить</p>
                    </div>
                </div>
            `
			cartProductsContainer.appendChild(productElement)

			// Обработчики событий
			productElement
				.querySelector('.cart__inner-product-move-count-more')
				.addEventListener('click', () => {
					item.quantity++
					saveCart()
					renderCart()
				})

			productElement
				.querySelector('.cart__inner-product-move-count-less')
				.addEventListener('click', () => {
					if (item.quantity > 1) {
						item.quantity--
					} else {
						cart.splice(index, 1) // Удаляем товар, если количество 0
					}
					saveCart()
					renderCart()
				})

			productElement
				.querySelector('.cart__inner-product-move-delete')
				.addEventListener('click', () => {
					cart.splice(index, 1) // Удаляем товар
					saveCart()
					renderCart()
				})

			totalAmount += item.quantity
			totalCost += item.cost * item.quantity
		})
	}

	// Применение скидки
	const discountedCost = totalCost - (totalCost * discount) / 100

	totalAmountElement.textContent = `${totalAmount} товаров`
	totalCostElement.textContent = `${totalCost.toFixed(2)}₽`
	totalItemsElement.textContent = `${discountedCost.toFixed(2)}₽`

	// Обработчик для применения промокода
	applyPromoCodeButton.addEventListener('click', () => {
		const promoCode = promoCodeInput.value.trim()

		// Проверка на наличие промокода
		const promo = promoCodes.find(p => p.code === promoCode)

		if (promo) {
			discount = promo.discount // Устанавливаем скидку
			discountMessage.textContent = `Промокод применен! Скидка ${discount}%`
			discountMessage.style.color = 'green'
		} else {
			discount = 0 // Сбрасываем скидку, если промокод недействителен
			discountMessage.textContent = 'Неверный промокод!'
			discountMessage.style.color = 'red'
		}

		// Обновляем отображение корзины с учетом скидки
		renderCart()
	})
}

function saveCart() {
	localStorage.setItem('cart', JSON.stringify(cart))
}

// Инициализация отображения корзины
document.addEventListener('DOMContentLoaded', () => {
	renderCart()
})

let isProcessing = false // Флаг для предотвращения повторной отправки

document.querySelector('#buy-btn').addEventListener('click', () => {
	if (isProcessing) return // Если уже обрабатывается запрос, выходим
	isProcessing = true // Устанавливаем флаг, что запрос в процессе

	const buyButton = document.querySelector('#buy-btn') // Получаем кнопку
	buyButton.disabled = true // Отключаем кнопку, чтобы предотвратить повторные нажатия

	if (cart.length === 0) {
		alert('Корзина пуста!')
		buyButton.disabled = false // Включаем кнопку обратно
		isProcessing = false // Сбрасываем флаг
		return
	}

	// Пример формирования данных для отправки
	const orderData = cart.map(item => ({
		id: item.id, // ID книги
		amount: item.quantity, // Количество
		total_price: item.cost * item.quantity, // Общая стоимость
	}))

	// Отправка данных на сервер
	fetch('/process-order.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({ cart: orderData }), // Отправляем только нужные данные
	})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				alert('Заказ успешно оформлен!')
				// Очистить корзину после оформления заказа
				localStorage.removeItem('cart')
				cart.length = 0 // Очищаем массив корзины
				renderCart() // Обновить корзину
			} else {
				alert(data.message)
			}
		})
		.catch(error => {
			console.error('Ошибка:', error)
			alert('Произошла ошибка при оформлении заказа.')
		})
		.finally(() => {
			buyButton.disabled = false // Включаем кнопку обратно после завершения запроса
			isProcessing = false // Сбрасываем флаг
		})
})
