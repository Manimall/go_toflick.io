// галерея картинок
$('.gallery-item__img-wrapper').magnificPopup({
	delegate: 'a',
	type: 'image',
	tLoading: 'Загрузка изображения #%curr%...',
	gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
	}
});

(function () {
const nav = document.querySelector('.main-nav');
const toggle = nav.querySelector('.toggle');

nav.classList.remove('main-nav--no-js');

toggle.addEventListener('click', function () {
	nav.classList.toggle('main-nav--opened');
});
})();