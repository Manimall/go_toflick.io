<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<main class="promo">
		<div class="promo__wrapper">
			<div class="promo__heading" style="background-image: url(<?= get_field('promo__img-wrapper'); ?>)"> <!-- full-width__img -->
				<h1 class="promo__title container">
					<?= get_field('promo__title'); ?>
				</h1>
				<div class="promo__subtitle container">
					<?= get_field('promo__subtitle'); ?>
				</div>
			</div>

			<div class="promo__main-part container">
				<section class="page-webinar">

					<div class="page-webinar__video">
						<?php $link = get_field('card__icon-link--video'); ?>
						<?php $newLink = split('&', $link); ?>
						<a class="about__video-link page-webinar__video-link" href="<?= $newLink[0] ?>">
							<div class="page-webinar__videoImg-wrapper" style="background-image: url(<?= get_field('page-webinar__videoImg-wrapper'); ?>)">
								<!-- <img src="<?= get_field('page-webinar__videoImg-wrapper'); ?>"> -->
							</div>
						</a>
					</div>

					<div class="page-webinar__content">
						<div class="page-webinar__heading">
							<div class="page-webinar__header">
								<h3 class="page-webinar__title"><?= get_the_title(); ?></h3>

								<div class="page-webinar__to-order">
									<div class="page-webinar__price">
										<?= get_field('order__price'); ?>
										<span class="page-webinar__currency"><?= get_field('order__currency'); ?></span>
									</div>
									<a href="#" class="page-webinar__text btn">Записаться</a>
								</div>
							</div>
							
							<?php if(isset($time) && isset($date)) : ?>

							<div class="page-webinar__date">
								<span class="page-webinar__full-date">
									<?php $date = get_field('sample__full-date'); ?>
									<?= $date ?>
								</span>
								<span class="page-webinar__time">
									<?php $time = get_field('sample__time'); ?>
									<?= $time ?>
								</span>
								<span class="page-webinar__time-zone">
									(мск время)
								</span>
							</div>

							<?php endif; ?>

						</div>

							<?php $pageInfo = get_field('page-webinar__info'); ?>
							<?php $tpl_dir = get_stylesheet_directory_uri(); ?>

						<div class="page-webinar__info">
							<ul class="page-webinar__list">
								<li class="page-webinar__item item item--presenter">
									<div class="item__img-wrapper">
										<img src="<?= $tpl_dir; ?>/source/img/icons_for_webinar/icon-teacher.png" class="item__img">
									</div>
									<div class="item__field">
										<span class="item__title">Лектор</span>
										<span class="item__content">
											<?= $pageInfo['item--presenter']; ?>
										</span>
									</div>
								</li>
								<li class="page-webinar__item item item--category">
									<div class="item__img-wrapper">
										<img src="<?= $tpl_dir; ?>/source/img/icons_for_webinar/icon-category.png"" class="item__img">
									</div>
									<div class="item__field">
										<span class="item__title">Категория</span>
										<span class="item__content">
											<?php $post    = get_post()?>
											<?php $taxs = get_the_terms($post->ID, 'platform')?>
											<ul>
											<?php foreach($taxs as $tax): ?>
												<?php if($tax->name !== 'Все'): ?>
													<li> <?= $tax->name ?> </li>
												<?php endif; ?>
											<?php endforeach; ?>
											</ul>
										</span>
									</div>
								</li>
								<li class="page-webinar__item item item--duration">
									<div class="item__img-wrapper">
										<img src="<?= $tpl_dir; ?>/source/img/icons_for_webinar/icon-duration.png" class="item__img">
									</div>
									<div class="item__field">
										<span class="item__title">Время</span>
										<span class="item__content">
											<?= $pageInfo['item--duration']; ?>
										</span>
									</div>
								</li>
								<li class="page-webinar__item item item--level">
									<div class="item__img-wrapper">
										<img src="<?= $tpl_dir; ?>/source/img/icons_for_webinar/icon-level.png" class="item__img">
									</div>
									<div class="item__field">
										<span class="item__title">Уровень</span>
										<span class="item__content">
											<?= $pageInfo['item--level']; ?>
										</span>
									</div>
								</li>
								<li class="page-webinar__item item item--price">
									<div class="item__img-wrapper">
										<img src="<?= $tpl_dir; ?>/source/img/icons_for_webinar/icon-price.png" class="item__img">
									</div>
									<div class="item__field">
										<span class="item__title">Цена</span>
										<span class="item__content">
											<?= get_field('order__price'); ?>
											<span class="order__currency item__currency"><?= get_field('order__currency'); ?></span>
										</span>
									</div>
								</li>
							</ul>
						</div>
					</div>

					<div class="page-webinar__description">
						<?= $pageInfo['page-webinar__description-text']; ?>
					</div>


					<div class="page-webinar__form">

					</div>
				</section>


				<aside class="more-webinars">

				<?php $webinars = new WP_Query(
					array("post_type" => "webinars",
							"posts_per_page" => "2", 
							"order" => "ASC",
							"orderby" => "rand",
							'post__not_in' => array( get_the_ID() )
						)
					)
				?>



				<?php if( !empty( $webinars ) ):?>

					<ul class="webinar__list more-webinars__list">
						<?php while ($webinars->have_posts()): $webinars->the_post()?>
								<li href="<?php the_permalink();?>" class="webinar__item-card card more-webinar__item">
									<article href="#" class="webinar__item-link card__link">
										<div class="card__img-wrapper" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>)" title="переход на страницу вебинара"></div>

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
				</aside>
			</div>
		</div>
	</main>

<?php wp_reset_query(); ?>

<?php endwhile;?>
<?php endif; ?>
<?php get_footer(); ?>
