<?
	
function enqueue(){
	    $theme = get_template_directory_uri();
	
        wp_deregister_script('jquery');
		wp_register_script('jquery', '//code.jquery.com/jquery-3.2.1.min.js');

        wp_register_script('main-js',  $theme . '/source/js/main.js');
		wp_register_script('js-inputmask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js');
		wp_register_script('js-magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js');  
		wp_register_script('js-owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');      
		
		//enqueue scripts
        wp_enqueue_script(array(
        	'jquery', 
            'js-magnific-popup',
        	'js-inputmask', 
        	'js-owl-carousel', 
            'main-js'
        ));

		//Theme stylesheet
		wp_register_style('magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css');
		wp_register_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
		wp_register_style('fonts', $theme . '/source/css/fonts.css');
		wp_register_style('style-css', $theme . '/source/css/style.css');
		wp_register_style('fontello', $theme . '/source/css/fontello.css');
		wp_register_style('fontello2', $theme . '/source/css/fontello2.css');
        
		//enqueue styles
        wp_enqueue_style(array(
			'font',
			'magnific-popup',
			'owl-carousel-css',
			'fontello',
			'fontello2',
	        'style-css'
        ));
}

add_action('wp_enqueue_scripts', 'enqueue');
	
function custom_post_type() {

  $labels = array(
        'name'               => 'Вебинары',
        'singular_name'      => 'Вебинар',
        'add_new'            => 'Добавить вебинар',
		'add_new_item'       => 'Добавить вебинар',
		'edit_item'          => 'Редактирование вебинара',
        'all_items'          => 'Все Вебинары',
        'edit_item'          => 'Редактировать конретный вебинар',
        'new_item'           => 'Новые Вебинары',
        'view_item'          => 'Просмор вебинаров',
        'search_items'       => 'Поиск Вебинаров',
        'not_found'          => 'Вебинары не найдены',
        'not_found_in_trash' => 'Вебинары не найдены',
        'menu_name'          => 'Вебинары'
    );

    $args = array(
        'labels'          => $labels,
        'show_ui'         => true,
        'supports'        => array( 'title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'public'          => true,
        'has_archive'     => false,
        'menu_position'   => 1,
		'menu_icon'       => 'dashicons-format-video',
		'hierarchical'    => false
    );

    register_post_type('webinars', $args );
}

add_action('init', 'custom_post_type');

function add_new_taxonomies() {		
	register_taxonomy('platform',
		array('webinars'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Категории',
				'add_new_item' => 'Добавить новую Категорию',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых Категорий',
				'separate_items_with_commas' => 'Разделяйте Категории запятыми',
				'menu_name' => 'Категории'
			),
			'public' => true, 
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true
		)
	);
}

add_action( 'init', 'add_new_taxonomies');

// добавляем возможность устанавливать миниатюру посту
add_theme_support('post-thumbnails');
    
// удаляем ненужные пункты меню в админке
function remove_menus()
{
	remove_menu_page( 'edit.php' );    
	remove_menu_page( 'edit-comments.php' ); 
}

add_action( 'admin_menu', 'remove_menus' );

// добавляем фильтр widget_text, позволяющий текстовым виджетам выполнять шорткод для oEmbed
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
add_filter( 'widget_text', 'do_shortcode');

// скрываем админ-панель
show_admin_bar(false);

add_shortcode('custom_playlist', 'custom_playlist');

// убираем обрамления в тег p
remove_filter( 'the_content', 'wpautop' );
remove_filter('the_content','wptexturize'); // Отключаем автоформатирование в полном посте
remove_filter('the_excerpt','wptexturize'); // Отключаем автоформатирование в кратком(анонсе) посте
remove_filter('comment_text', 'wptexturize'); // Отключаем автоформатирование в комментариях

## Удаление виджетов из Консоли WordPress
add_action( 'wp_dashboard_setup', 'clear_dash', 99 );
function clear_dash(){
	$side   = & $GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
	$normal = & $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

	// die( print_r($GLOBALS['wp_meta_boxes']['dashboard']) ); // смотрим что есть...

	$remove = array(
		'dashboard_activity', // последняя активность
		'dashboard_primary',  // новости wordpress
		// 'dashboard_right_now',  // консоль
	);
	foreach( $remove as $id ){
		unset( $side[$id], $normal[$id] ); // или $side или $normal
	}

	// удалим welcome панель
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

// allow SVG uploads
add_filter( 'upload_mimes', 'upload_allow_types' );
function upload_allow_types( $mimes ) {
	// разрешаем новые типы
	$mimes['svg']  = 'image/svg+xml';
	$mimes['doc']  = 'application/msword'; 
	$mimes['woff'] = 'font/woff';
	$mimes['psd']  = 'image/vnd.adobe.photoshop'; 
	$mimes['djv']  = 'image/vnd.djvu';
	$mimes['djvu'] = 'image/vnd.djvu';

	// отключаем имеющиеся
	// unset( $mimes['mp4a'] );

	return $mimes;
}

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
  $existing_mimes['svg'] = 'image/svg+xml';
  return $existing_mimes;
}
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}

/**
 * Allow SVG files in Media Library.
 */
function extra_mime_types( $mimes ) {

	$mimes['svg'] = 'image/svg+xml';
  
	return $mimes;
  }

add_filter( 'upload_mimes', 'extra_mime_types' );

add_action('admin_head', 'fix_svg');

add_theme_support('custom-logo');

//неразрывне пробелы
function my_mce_set( $init_array ) {
	$init_array['entity_encoding'] = 'named';
	$init_array['entities'] ='160,nbsp';
	return $init_array;
  }

add_filter( 'tiny_mce_before_init', 'my_mce_set' );

// remove_filter('the_content', 'wpautop');

//sorting categories
function my_category_order($orderby, $args) {
    if($args['orderby'] == 'sort')
        return 't.sort';
    else
        return $orderby;
}

add_filter('get_terms_orderby', 'my_category_order', 10, 2);


// Assigning Category to a Post Automatically
function auto_add_category ($post_id = 0) {
	if (!$post_id) return;
	$tag_categories = array ( // add multiple items as shown 'Tag Name' => 'Categroy Name'
	 'platform' => 'Все'
	);
	$post_tags = get_the_tags($post_id);
	foreach ($post_tags as $tag) {
	  if ($tag_categories[$tag->name] ) {
		$cat_id = get_cat_ID($tag_categories[$tag->name]);
		if ($cat_id) {
		  $result =  wp_set_post_terms( $post_id, $tags = $cat_id, $taxonomy = 'platform', $append = true );
		}
	  }
	}
}

add_action('publish_post','auto_add_category');

