<?php $url = get_stylesheet_directory_uri();?>
<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

<main>
	<section class="hero">
		<div class="hero__wrapper container">
			<div class="hero__logo">
				<img src="<?= $url ?>/source/img/hero__logo.png" alt="Логотип в хедере">
			</div>

			<div class="hero__title">
				<h2 class="hero__title-text title">Авторский курс вебинаров по английскому языку</h2>
			</div>
		</div>
	</section>

	<section class="invitation-form form">
		<div class="form__wrapper container">
			<?php echo do_shortcode( '[contact-form-7 id="36" title="Форма после секции Hero"]' ); ?>
		</div>
	</section>

	<section class="about" id="about">
		<?php $about = get_field('about'); ?>
		<?php if( !empty($about) ): ?>

		<div class="about__wrapper container">
			<div class="about__video">
				<a class="about__video-link" href="<?= $about['about__video-link'];?>">
					<div class="about__videoImg-wrapper" style="background-image: url(<?= $about['about__videoImg-wrapper'];?>)">
						<!-- <img src="<?= $about['about__videoImg-wrapper'];?>"> -->
					</div>
				</a>
			</div>

			<div class="about__info">
				<h2 class="about__title">Несколько слов обо мне</h2>
				<div class="about__text">
					<?= $about['about__text']; ?>
				</div>
			</div>
		</div>

		<?php endif; ?>
	</section>

	<section class="sertificate" id="certificats">
		<div class="sertificate__wrapper container">

			<?php $images = get_field('sertificate__images'); ?>

			<template>
				<!-- <pre> -->
				<!-- <?= print_r($images);_?> -->
			</template>

			<?php if( !empty($images) ): ?>

			<ul class="sertificate__list">

				<div id="carouselCertificate" class="owl-carousel owl-theme">

					<?php foreach( $images as $image ): ?>
						<li class="sertificate__img-wrapper sertificate__item">
							<a href="<?= $image['url']; ?>" class="sertificate__img-link">
								<img class="sertificate__img" src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
							</a>
						</li>
					<?php endforeach; ?>

				</div>
			</ul>

			<?php endif; ?>

		</div>
	</section>

	<section class="webinar" id="webinars">
		<div class="webinar__wrapper container">
			<h3 class="webinar__title">Мои вебинары</h3>
			<div class="webinar__description">
				<?= get_field('webinar__description-text'); ?>
			</div>
			<?php  $categories = get_terms('platform', 'orderby=name&hide_empty=0'); ?>

			<ul class="webinar__nav">
				<?php $i = 0; ?>
				<?php $categories = get_categories( array(
					'order'    => 'ASC',
					// 'orderby'  => 'ID',
					'orderby'  => 'sort',
					'hide_empty'   => 0,
					'taxonomy'  => 'platform'
				));
				?>
					<?php foreach ($categories as $cat): ?>

						<li class="webinar__item">
							<a href="<?= get_category_link( $cat->term_id ); ?>" class="tab-button webinar__link" data-tab="<?= $i ?>"><?= $cat->name ?></a>
						</li>

						<?php $i++; ?>
					<?php endforeach; ?>	

			</ul>

			<div class="webinar__content-wrapper">

				<?php $i = 0; ?>

				<?php if($categories): ?>
					<?php foreach ($categories as $cat): ?>
					<?php $webinars = new WP_Query(
						array("post_type" => "webinars",
								"posts_per_page" => "-1", 
								"order" => "ASC",
								"orderby" => "date",
								'tax_query' => array(
									array(
										'taxonomy' => 'platform',
										'field'    => 'slug',
										'terms'    => $cat->slug
									),
								),
							)
						)
					?>

					<?php if( !empty( $webinars ) ):?>
						<ul class="webinar__list" data-tab="<?= $i; ?>">
							<?php while ($webinars->have_posts()): $webinars->the_post()?>

								<li class="webinar__item-card card">
									<article href="<?php the_permalink();?>" class="webinar__item-link card__link">
										<div class="card__img-wrapper" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>)" title="переход на страницу вебинара">
											<!-- <img class="card__img" src="<?= get_the_post_thumbnail_url(); ?>" alt="Изображение вебинара"> -->
											<ul class="card__icons">
												<li class="card__icon-item">
													<?php $videoLink = get_field('card__icon-link--video'); ?>
													<?php $newLink = split('&', $videoLink); ?>
													<a href="<?= $newLink[0] ?>" class="card__icon-link card__icon-link--video" title="видео вебинара"></a>
												</li>
												<li class="card__icon-item">
													<a href="<?= get_field('card__icon-link--img'); ?>" class="card__icon-link card__icon-link--img" title="изображение вебинара"></a>
												</li>
											</ul>
										</div>

										<div class="card__info">
											<h3 class="card__title"><?= get_the_title(); ?></h3>
											<p class="card__description">
												<?= get_the_content(); ?>
											</p>

											<div class="card__to-order">
												<a href="<?php the_permalink();?>" class="order__text">Записаться</a>
												<a href="<?php the_permalink();?>" class="order__price btn">
													<?= get_field('order__price'); ?>
													<span class="order__currency"><?= get_field('order__currency'); ?></span>
												</a>
											</div>
										</div>
									</article>
								</li>

							<?php endwhile; ?>					
						</ul>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					
					<?php $i++; ?>

					<?php endforeach; ?>
				<?php endif; ?>

			</div>
		</div>
	</section>


	<section class="current-webinars">
		<div class="current-webinars__wrapper container">


			<?php $current_webinars = new WP_Query(array(
				"post_type" => "webinars",
				"posts_per_page" => "3",
				'order'  => 'DESC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> $date,
				'meta_query' => array(
					array(
						'key' => 'sample__to-be',
						'compare' => '==',
						'value' => '1'
					)
				)
			))?>
			

			<?php if($current_webinars->have_posts()):?>

				<?php while($current_webinars->have_posts()): $current_webinars->the_post()?>
						
					<h3 class="current-webinars__title">Вебинары на эту неделю</h3>

					<ul class="current-webinars__list">

						<li class="current-webinars__item sample">

							<!-- <?= $date = get_field('sample__full-date'); ?> -->

							<div class="sample__images-wrapper" style="background-image: url(<?= get_field('sample__date-img'); ?>)">
								<!-- <img class="sample__main-img" src="<?= get_field('sample__date-img'); ?>" alt=""> -->
								<div class="sample__date-wrapper">
									<p class="sample__date-day">
										<?= get_field('sample__date-day'); ?>
									</p>
									<p class="sample__date-month">
										<?= get_field('sample__date-month'); ?>
									</p>
									<div class="sample__date-year--wrapper">
										<p class="sample__date-year">
											<?= get_field('sample__date-year'); ?>
										</p>
										<span class="sample__date-year--text">года</span>
									</div>
								</div>
							</div>

							<div class="sample__info">
								<h4 class="sample__title"><?= get_the_title(); ?></h4>
								<p class="sample__time">16:00-17:00</p>
								<p class="sample__description">
									<?= get_the_content(); ?>
								</p>
								<div class="sample__to-order">
									<a href="<?php the_permalink(); ?>" class="order__text">Записаться</a>
									<a href="<?php the_permalink(); ?>" class="order__price btn">
										<?= get_field('order__price'); ?>
										<span class="order__currency"><?= get_field('order__currency'); ?></span>
									</a>
								</div>
							</div>
						</li>

					</ul>

				<?php endwhile; ?>					
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>
<?php endwhile; ?>
<?php get_footer();?>