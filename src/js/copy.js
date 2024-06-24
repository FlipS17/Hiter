const popup = document.querySelector('.popup');

document.querySelectorAll('.copy-button').forEach(button => {
	button.addEventListener('click', function () {
		popup.classList.add('show');
		setTimeout(() => {
			popup.classList.remove('show');
		}, 2500);
		const promoText = this.parentElement.querySelector(
			'.sales__cards-card-info-promo-text'
		).innerText;

		navigator.clipboard
			.writeText(promoText)
			.then(function () {
				console.log('Text copied to clipboard');
			})
			.catch(function (error) {
				console.error('Error:', error);
			});
	});
});
