// Получаем кнопку, которая открывает модальное окно
const buttonReg = document.querySelector('.button-reg')

// Создаем модальное окно
const modalReg = document.createElement('div')
modalReg.className = 'modal-reg'
modalReg.innerHTML = `
  <div class="modal-header">
  <img src='/src/img/mainpage/logo.svg'>
    <h2 class='modal-title'>Регистрация</h2>
    <button class="modal-close">X</button>
  </div>
    <form class='reg-form' method="post" action='/reg.php'>
		<div class='container-input'>
		 <input placeholder='Имя' type="text" name="name" class='reg-input-name request__input'>
			<input placeholder='Фамилия' type="text" name="surname" class='reg-input-surname request__input'>
			<input placeholder='Отчество' type="text" name="otch" class='reg-input-otch request__input'>
			<input placeholder='E-mail' type="text" name="email" class='reg-input-email request__input'>
			<input placeholder='Логин' type="text" name="login" class='reg-input-login request__input'>
			<input placeholder='Пароль' type="text" name="password" class='reg-input-password request__input'>
			<input placeholder='Подтвердите пароль' type="text" name="repassword" class='reg-input-repassword request__input'>
		</div>
     

			


			<button type="submit" name="reg-sumbit" class='reg-submit-button button'> Зарегистрироваться</button>
  </form>
    </form>
`

// Создаем задний фон модального окна
const modalOverlayReg = document.createElement('div')
modalOverlayReg.className = 'modal-overlay-reg'

// Добавляем модальное окно и задний фон на страницу
document.body.appendChild(modalReg)
document.body.appendChild(modalOverlayReg)

// Функция, которая открывает модальное окно
function openModalReg() {
	modalReg.style.display = 'block'
	modalOverlayReg.style.display = 'block'
}

// Функция, которая закрывает модальное окно
function closeModalReg() {
	modalReg.style.display = 'none'
	modalOverlayReg.style.display = 'none'
}

// Добавляем обработчик события кнопке, которая открывает модальное окно
buttonReg.addEventListener('click', openModalReg)

// Добавляем обработчик события кнопке закрытия модального окна
modalReg.querySelector('.modal-close').addEventListener('click', closeModalReg)

// Добавляем обработчик события клика на задний фон модального окна
modalOverlayReg.addEventListener('click', closeModalReg)
