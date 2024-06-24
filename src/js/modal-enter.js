const buttonEnter = document.querySelector('.button-enter');

// Создаем модальное окно
const modal = document.createElement('div');
modal.className = 'modal';
modal.innerHTML = `

  <div class="modal-header">
  <img src='/src/img/mainpage/logo.svg'>
    <h2 class='modal-title'>Авторизация</h2>
    <button class="modal-close">X</button>
  </div>
  <form class='enter-form' method='post' action='../pages/account.php'>
  <input placeholder='Логин' type="text" name='login-enter' id="login" class='enter-input-login request__input'>
  <input placeholder='Пароль' type="text" name='password-enter' id="password" class='enter-input-password request__input'>

  <div class="g-recaptcha" data-sitekey="6LdypfkpAAAAAKOGUJGrFpocpfLk0cK2g59RdKFJ"></div>

  <input type="submit" value='Войти' id="enter-sumbit" class='enter-submit-button button'>
  </form>

  <script>
    function onClick(e) {
      e.preventDefault();
      grecaptcha.enterprise.ready(async () => {
        const token = await grecaptcha.enterprise.execute(
          '6LdypfkpAAAAAKOGUJGrFpocpfLk0cK2g59RdKFJ',
          { action: 'LOGIN' }
        );
        document.querySelector('.enter-form').submit();
      });
    }
  </script>
`;

// Создаем задний фон модального окна
const modalOverlay = document.createElement('div');
modalOverlay.className = 'modal-overlay';

// Добавляем модальное окно и задний фон на страницу
document.body.appendChild(modal);
document.body.appendChild(modalOverlay);

// Функция, которая открывает модальное окно
function openModal() {
	modal.style.display = 'block';
	modalOverlay.style.display = 'block';
}

// Функция, которая закрывает модальное окно
function closeModal() {
	modal.style.display = 'none';
	modalOverlay.style.display = 'none';
}

// Добавляем обработчик события кнопке, которая открывает модальное окно
buttonEnter.addEventListener('click', openModal);

// Добавляем обработчик события кнопке закрытия модального окна
modal.querySelector('.modal-close').addEventListener('click', closeModal);

// Добавляем обработчик события клика на задний фон модального окна
modalOverlay.addEventListener('click', closeModal);
