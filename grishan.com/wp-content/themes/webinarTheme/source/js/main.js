$(document).ready(function() {
	$('#carouselCertificate').owlCarousel({
		loop: false, //Зацикливаем слайдер
	  	margin:30, //Отступ от картинок если выводите больше 1
		nav:true, //Включим стрелочки
		navText: ['<div class="prev-wrap" aria-hidden="true"><img class="prev" src="/wp-content/themes/webinarTheme/source/img/prev.png"></div>',
              '<div class="next-wrap" aria-hidden="true"><img class="next" src="/wp-content/themes/webinarTheme/source/img/next.png"></div>' ],
	  // autoplay:true, //Автозапуск слайдера
		smartSpeed:2000, //Время движения слайда
		autoplayTimeout:2000, //Время смены слайда
	  touchDrag: true, //this one for mobile and planshets
	  lazyLoad:true, //Smooth-scroll
	  autoplayTimeout:3500, //Интервалы между пролистыванием элементов
	  autoplayHoverPause: false, //Останавливает автопроигрывание если навести мышкой (hover) на элемент
	  responsive:{ //Адаптация в зависимости от разрешения экрана
		0:{
		  items:1
		},
		440:{
		  items:2
		},
		850: {
			items:3
		},
		1250:{
		  items:4
		}
	  }
	});

	// checking url of current page
	var pages = window.location.href;
	var hostname = window.location.hostname;
	var r = new RegExp(`^(ftp|http|https):\/\/${hostname}\/webinars\/[^ "]+$`);	


	if (pages === window.location.origin + '/') {
		var showMessage = function (text, EmptyElement) {
			var errorBlockElement = document.createElement('div');
					errorBlockElement.classList.add('error-message');
					errorBlockElement.style.background = 'yellow';
					errorBlockElement.style.position = 'relative';
					errorBlockElement.style.zIndex = '2';
					errorBlockElement.style.top = '0';
					errorBlockElement.style.display = 'flex';
						errorBlockElement.style.width = '80%';
						errorBlockElement.style.margin = 'auto';
		
			var errorTextElement = document.createElement('p');
						errorTextElement.style.color = 'rgba(250, 248, 255, 1)';
						errorTextElement.style.color = '#6463c2';
					errorTextElement.style.fontWeight = 'bold';
					errorTextElement.style.fontSize = '24px';
						errorTextElement.style.margin = '20px auto';
						errorTextElement.style.filter = 'brightness(50%)';
					errorTextElement.textContent = text;
		
			errorBlockElement.appendChild(errorTextElement);
				EmptyElement.appendChild(errorBlockElement);
		};
		
		// переключение в секции Мои Вебинары 
		var tabControls = document.querySelectorAll('.webinar__link'); // коллекция табов  
		tabControls[0].classList.add('webinar__link--current'); // добавляем active class первому табу 
		var tabsList = document.querySelector('.webinar__nav'); // список (ul), в котором хранятся все табы  
		var tabsContent = document.querySelectorAll('.webinar__list'); // содержимое табов 

		// tabsContent.forEach(el => el.classList.add('hidden'));
		// tabsContent[0].classList.remove('hidden');

		// tabsContent.filter((elem, index) => (index !== 0).forEach(el => el.classList.add('hidden'));
		tabsContent.forEach((el, i) => {if(i !== 0) {el.classList.add('hidden')}});
	
		var getEmptyElement = function (el, currTab) {
			if (el.children.length === 0) {
				return showMessage('В категории ' +  '"'+currTab+'"' + ' нет вебинаров' , el);
			}
		};
		
		// если содержимое таба пустое - выводим соответствующее сообщение
		tabsContent.forEach(function(item, i) { 
			getEmptyElement(item, tabControls[i].textContent); 
		}); 
		
		tabsList.addEventListener('click', function (evt) { 
			if (evt.target.classList.contains('webinar__link')) { 
			evt.preventDefault();
	
			// dataTab - номер вкрладки, которую нужно отобразить 
			var dataTab = parseInt(evt.target.getAttribute("data-tab")); 
		
			tabControls.forEach (function(tab) { 
				tab.classList.remove('webinar__link--current'); 
			}); 
		
			evt.target.classList.add('webinar__link--current');
			// evt.target.style.transform = 'translateY(1px)';
			// evt.target.style.transition = 'transform 0.15s ease-in-out';
				
			tabsContent.forEach(function(item, i) { 
				item.classList.add('hidden');
				if (dataTab === i) { 
				// item.style.display = 'grid';
				item.classList.remove('hidden'); 
				} else { 
				// item.style.display = 'none';
				item.classList.add('hidden');
				} 
			}); 
			} 
		});
	
		// делаем карточки ссылками
		var webinarList = document.querySelectorAll('.webinar__list');
		// console.log(webinarList);
		webinarList.forEach(function (list) {
			var webinarCards = list.querySelectorAll('.webinar__item-link');
			// console.log(webinarCards);

			webinarCards.forEach(function (card) {
				card.addEventListener('click', function(evt) {
					if  (evt.target.classList.contains('card__icon-link')) {
						return;
					} else {
						document.location.href = card.getAttribute('href');
					}
				});
			});
		});
		
		
		//якорные ссылки на главной
		$(function(){
			jQuery('.main-nav__link').on('click', function(e){
				e.preventDefault();

				var link = $(this).attr('href');
				var scrollSpeed = 900;
				var links = $('.main-nav__link');
				var index = links.index(this);
		
				$("html, body").animate({
					scrollTop: $(link).position().top
				}, (scrollSpeed/3 * index) + scrollSpeed);
		
				link = link.substring(1, link.length);
		
				window.history.pushState("", link, "/"+link)
				return false;
			});		
		});
	}

	else if(r.test(pages)) {
		//don't do anything right now
		document.querySelector('body').classList.add('webinars-page');

		var moreWebinarSection = document.querySelector('.more-webinars__list');

		var moreWebinarCards = moreWebinarSection.querySelectorAll('.more-webinar__item');

		moreWebinarCards.forEach(function (card) {
			card.addEventListener('click', function() {
				document.location.href = card.getAttribute('href');
			})
		})
	}


	//открытие и закрытие mobile menu
	var navMain = document.querySelector(".page-header__wrapper"); //обертка для меню
	var btnToggle = document.querySelector(".burger-wrapper"); //кнопка открытия/закрытия меню

	btnToggle.addEventListener("click", function() {

	if (navMain.classList.contains("open-menu")) {
		// btnToggle.classList.add('burger-wrapper-close');
		navMain.classList.remove("open-menu");
		document.querySelector('body').classList.remove('mobile-menu');
	} else {
		navMain.classList.add("open-menu");
		document.querySelector('body').classList.add('mobile-menu');
		// navMain.classList.remove("toggle--opened");
		btnToggle.classList.remove('burger-wrapper-close');
	}

	this.classList.toggle("burger-wrapper-close");
	});

	var links = document.querySelectorAll('.main-nav__link');
	links.forEach(function (link) {
		link.addEventListener('click', function() {
			navMain.classList.remove("open-menu");
			document.querySelector('body').classList.remove('mobile-menu');
			btnToggle.classList.remove('burger-wrapper-close');
		})
	})

	$('.sertificate__item').magnificPopup({
		delegate: 'a',
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		zoom: {
			enabled: true,
			duration: 3 // animation-duration
		},
		callbacks: {
			beforeOpen: function() {
			// just a hack that adds mfp-anim class to markup 
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		},
		closeOnContentClick: true,
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
            tCounter: '%curr% / %total%'
		},
		midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});

	$('.about__video-link').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		iframe: {		  
			patterns: {
			  youtube: {
				src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
			  }	  
			},
		}
	});

	$('.card__icon-link--img').magnificPopup({
		// delegate: 'a',
		type: 'image',
		removalDelay: 500, //delay removal by X to allow out-animation
		zoom: {
			enabled: true,
			duration: 1 // animation-duration
		},
		image: {
			verticalFit: true
		}
	});

	$('.card__icon-link--video').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
	});

	jQuery('input[type="tel"]').on('click', function (){
		jQuery('input[type="tel"]').show('slow').inputmask("+7 (999) 999-99-99");
	});
	
});