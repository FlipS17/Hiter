function adminAppear() {
	const adminElement = document.querySelector('.admin-pannel');

	adminElement.classList.toggle('none');
}
document.querySelector('.admin-button').addEventListener('click', adminAppear);
