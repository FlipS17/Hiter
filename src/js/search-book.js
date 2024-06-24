const searchInput = document.querySelector('.search__input');
const books = document.querySelectorAll('.book__books-card');

searchInput.addEventListener('input', () => {
	const inputValue = searchInput.value.toLowerCase();
	books.forEach(book => {
		const bookTitle = book
			.querySelector('.book__books-card-name')
			.textContent.toLowerCase();
		const bookAuthor = book
			.querySelector('.book__books-card-author')
			.textContent.toLowerCase();
		if (bookTitle.includes(inputValue) || bookAuthor.includes(inputValue)) {
			book.style.display = 'block';
		} else {
			book.style.display = 'none';
		}
	});
});
