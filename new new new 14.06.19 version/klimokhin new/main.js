// галерея картинок
$('.gallery-item__img-wrapper').magnificPopup({
	delegate: 'a',
	type: 'image',
	fixedContentPos: true,
	fixedBgPos: true,
	tLoading: 'Загрузка изображения #%curr%...',
	gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
        tCounter: '<span class="mfp-counter">%curr% / %total%</span>' // markup of counter
	}
});

(function () {
    $('.author__gallery-list').magnificPopup({
        delegate: 'a',
        fixedContentPos: true,
        fixedBgPos: true,
        type: 'image',
        tLoading: 'Загрузка изображения #%curr%...',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            tCounter: '<span class="mfp-counter">%curr% / %total%</span>' // markup of counter
        }
    });
})();

(function () {
const nav = document.querySelector('.main-nav');
const toggle = nav.querySelector('.toggle');
const currentPage = document.querySelector('.current-page-link');

nav.classList.remove('main-nav--no-js');

toggle.addEventListener('click', function () {
	nav.classList.toggle('main-nav--opened');
    currentPage.classList.toggle('hidden');
});
})();


//scroll to top
(function () {
    $('.scrollToTop').hide();
        $(window).scroll(function () {
            if( $(this).scrollTop() > 100 ) {
                $('.scrollToTop').fadeIn(300);
                $('.scrollToTop').addClass('flex-container');
                $('.scrollToTop').removeClass('hidden');
            }
            else {
                $('.scrollToTop').fadeOut(300);
                $('.scrollToTop').addClass('hidden');
                $('.scrollToTop').removeClass('flex-container');
            }
    });

    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop:0}, 500 );
        return false;
    });
})();
