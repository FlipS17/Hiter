const searchInput = document.querySelector('.search__input');
searchInput.addEventListener('input', () => {
	const inputValue = searchInput.value.toLowerCase();
	const authors = document.querySelectorAll('.all-authors__author');
	authors.forEach(author => {
		const authorName = author
			.querySelector('.all-authors__author-name')
			.textContent.toLowerCase();
		if (authorName.includes(inputValue)) {
			author.style.display = 'block';
		} else {
			author.style.display = 'none';
		}
	});
});
