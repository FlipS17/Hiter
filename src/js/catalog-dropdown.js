let dropdown = document.getElementById('dropdown');
let options = [
	{ text: 'По популярности', value: 'popularity' },
	{ text: 'По цене ↑', value: 'price-asc' },
	{ text: 'По цене ↓', value: 'price-desc' },
	{ text: 'По новизне', value: 'newness' },
];

let selectedOption = options[0];

// Создаем кнопку дропдауна
let button = document.createElement('button');
button.textContent = selectedOption.text;
button.onclick = toggleDropdown;
dropdown.appendChild(button);

// Создаем список опций
let list = document.createElement('ul');
list.style.display = 'none';
dropdown.appendChild(list);

// Создаем элементы списка
options.forEach(option => {
	let item = document.createElement('li');
	item.textContent = option.text;
	item.onclick = () => {
		selectedOption = option;
		button.textContent = option.text;
		toggleDropdown();
		removeOptionFromList(option);
	};
	list.appendChild(item);
});

// Функция toggleDropdown
function toggleDropdown() {
	list.style.display = list.style.display === 'none' ? 'block' : 'none';
}

// Функция для удаления опции из списка
function removeOptionFromList(option) {
	let listItem = list.querySelector(`li:contains(${option.text})`);
	listItem.remove();
}

// Функция для закрытия дропдауна при клике вне его
document.addEventListener('click', e => {
	if (!dropdown.contains(e.target)) {
		list.style.display = 'none';
	}
});
