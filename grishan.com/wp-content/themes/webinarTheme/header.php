<?php $url = get_stylesheet_directory_uri();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="google-site-verification" content="String_we_ask_for">
	<title><?php bloginfo('description'); ?></title>
	<?php wp_head()?>
</head>

<body>
	<header class="page-header">
		<section class="burger-container container">
			<div class="logo page-header-nav__logo">
				<?php the_custom_logo( $blog_id ); ?>
			</div>

			<div class="burger-wrapper">
				<div class="square square1"></div>
				<div class="square square2"></div>
				<div class="square square3"></div>
				<div class="square square4"></div>
				<div class="square square5"></div>
				<div class="square square6"></div>
				<div class="square square7"></div>
				<div class="square square8"></div>
				<div class="square square9"></div>
			</div>
		</section>

		<div class="page-header__wrapper">
			<!-- <div class="nav__bg"></div> -->

			<section class="page-header-top">
				<div class="page-header-top__wrapper container">
					<ul class="header-top__list">

						<!-- <?php $contacts = get_field('contacts'); ?> -->

						<li class="header-top__item">
							<a  href="skype:Inna Grishan?call" class="header-top__link header-top__link--skype">
								<i class="header-icon icon-skype-outline"></i>	
								Inna Grishan
							</a>
						</li>
						<li class="header-top__item">
							<a href="tel:+7 (925) 704-96-63" class="header-top__link header-top__link--phone">
								<i class="header-icon icon-phone"></i>
								+7 (925) 704-96-63
							</a>
						</li>
						<li class="header-top__item">
							<a href="mailto:inna.grishan@mail.ru" class="header-top__link header-top__link--mail">
								<i class="header-icon icon-mail-alt"></i>
								inna.grishan@mail.ru
							</a>
						</li>
					</ul>
				</div>
			</section>

			<section class="page-header-nav">
				<div class="page-header-nav__wrapper container">

					<div class="logo page-header-nav__logo" title="на главную">
						<!-- <a href="#" class="logo__link"> -->
							<?php the_custom_logo( $blog_id ); ?>
						<!-- </a> -->
					</div>

					<div class="main-nav page-header-nav__main-nav">
						<ul class="main-nav__list main-nav__list--index">
							<?php if( is_front_page() ) : ?>
								<!-- // echo "Это главная страница"; -->
								<li class="main-nav__item">
									<a href="#about" class="main-nav__link main-nav__link--active">обо мне</a>
								</li>
								<li class="main-nav__item">
									<a href="#certificats" class="main-nav__link">сертификаты</a>
								</li>
								<li class="main-nav__item">
									<a href="#webinars" class="main-nav__link">вебинары</a>
								</li>
							<?php else : ?>
								<!-- // echo "это не главная страница"; -->
							
								<li class="main-nav__item">
									<a href="<?= home_url('/'); ?>" class="main-nav__link">главная</a>
								</li>
							<?php endif; ?>
							
							<li class="main-nav__item main-nav__item-social">
								<a href="https://www.instagram.com/english.inna/" class="main-nav__link-social social--insta" target="_blank">
									<i class="icon-instagram"></i>
								</a>
								<a href="https://www.youtube.com/channel/UCv1qvOxIBWxy9pfxblsmCJA" class="main-nav__link-social social--youtube" target="_blank">
									<i class="icon-youtube-play"></i>
								</a>
								<a href="https://www.facebook.com/InnaGrishan/" class="main-nav__link-social social--fb" target="_blank">
									<i class="icon-fb-squared"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</section>
		</div>
	</header>
