import '../scss/style.scss';
import '../js/copy.js';
// // Добавляем маску для даты
// function doFormat(value, pattern, mask) {
// 	// удаляем все нечисловые значения из значения
// 	const strippedValue = value.replace(/[^0-9]/g, '');

// 	// преобразуем строку-значение в массив символов
// 	const chars = strippedValue.split('');

// 	let count = 0;
// 	let formatted = '';

// 	// форматируем строку
// 	for (let i = 0; i < pattern.length; i++) {
// 		const char = pattern[i];
// 		if (chars[count]) {
// 			if (/\*/.test(char)) {
// 				const val = parseInt(chars[count]);
// 				if (
// 					(i === 0 || i === 1 || i === 2 || i === 3) && // год
// 					(val < 0 || val > 9)
// 				) {
// 					return ''; // или вы можете вернуть ошибку
// 				} else if (
// 					(i === 4 || i === 5) && // месяц
// 					(val < 0 || val > 1 || (val === 1 && chars[count + 1] > 2))
// 				) {
// 					return ''; // или вы можете вернуть ошибку
// 				} else if (
// 					(i === 6 || i === 7) && // день
// 					(val < 0 || val > 3 || (val === 3 && chars[count + 1] > 1))
// 				) {
// 					return ''; // или вы можете вернуть ошибку
// 				}
// 				formatted += chars[count];
// 				count++;
// 			} else {
// 				formatted += char;
// 			}
// 		} else if (mask) {
// 			const splittedMask = mask.split('');

// 			if (splittedMask[i]) {
// 				formatted += splittedMask[i];
// 			}
// 		}
// 	}

// 	return formatted;
// }

// // проходимся по каждому элементу назначая на них обработчики
// // нажатия клавиш
// document.querySelectorAll('[data-mask]').forEach(function (e) {
// 	function format(elem) {
// 		const val = doFormat(elem.value, elem.getAttribute('data-format'));
// 		elem.value = doFormat(
// 			elem.value,
// 			elem.getAttribute('data-format'),
// 			elem.getAttribute('data-mask')
// 		);

// 		if (elem.createTextRange) {
// 			var range = elem.createTextRange();
// 			range.move('character', val.length);
// 			range.select();
// 		} else if (elem.selectionStart) {
// 			elem.focus();
// 			elem.setSelectionRange(val.length, val.length);
// 		}
// 	}

// 	e.addEventListener('input', function () {
// 		format(e);
// 	});

// 	format(e);
// });

