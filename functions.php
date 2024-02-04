<?php

// Add Theme Support
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'] );
add_theme_support( 'html5' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-logo' );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support( 'starter-content' );


function soultrust_files() {
  wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'));
  wp_enqueue_style('google-font1', '//fonts.googleapis.com/css2?family=Oswald:wght@100;300;400;700&display=swap');
  wp_enqueue_style('google-font2', '//fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap');
  wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
  wp_enqueue_style('main-styles', get_stylesheet_directory_uri() . '/style.css');
  wp_enqueue_style('extra-styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('dashicons');

  // To change root url on production / local
  wp_localize_script(
    'main-js', 'k6', array(
      'root_url' => get_site_url()
    )
  );
}
add_action('wp_enqueue_scripts', 'soultrust_files');

function k6_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'k6_features');

// Make admin use main style from front end
// function ourLoginCSS() {
//   wp_enqueue_style( 'login-style', get_theme_file_uri('/build/style-login.css'));
//   wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet');
// }
// add_action('login_enqueue_scripts', 'ourLoginCSS');

function login_styles() {
  wp_enqueue_style( 'custom-styles', get_theme_file_uri('/build/style-index.css'));
}
add_action( 'login_enqueue_scripts', 'login_styles' );

// The following is necessary for enabling usage of js modules
function add_type_attribute($tag, $handle, $src) {
  // if not your script, do nothing and return original $tag
  if ( 'main-js' !== $handle ) {
      return $tag;
  }
  // change the script tag by adding type="module" and return it.
  $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
  return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

// Enable "Widgets" admin section
function k6_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'k6_widgets_init' );

// Enable tags for recipes
function gp_register_taxonomy_for_object_type() {
    register_taxonomy_for_object_type( 'post_tag', 'recipe' );
};
add_action( 'init', 'gp_register_taxonomy_for_object_type' );

// Color Customizer
function color_customize_register( $wp_customize ) {
  $wp_customize->add_setting('base_bg_color', array(
    'default' => '#ffffff',
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('border_text_color', array(
    'default' => '#000000',
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('header_overlay_color', array(
    'default' => '#ffffff',
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('header_overlay_opacity', array(
    'default' => 0,
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('link_color', array(
    'default' => '#000000',
    'transport' => 'refresh',
  ));
  $wp_customize->add_section('soultrust_colors', array(
    'title' => __('Colors', 'Soultrust'),
    'priority' => 30,
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'base_bg_color_control', array(
    'label' => __('Base Background Color', 'Soultrust'),
    'section' => 'soultrust_colors',
    'settings' => 'base_bg_color',
  )));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'border_text_color_control', array(
    'label' => __('Border & Base Text Color', 'Soultrust'),
    'section' => 'soultrust_colors',
    'settings' => 'border_text_color',
  )));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_control', array(
    'label' => __('Link Color', 'Soultrust'),
    'section' => 'soultrust_colors',
    'settings' => 'link_color',
  )));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_overlay_color_control', array(
    'label' => __('Header Overlay Color', 'Soultrust'),
    'section' => 'soultrust_colors',
    'settings' => 'header_overlay_color',
  )));
  $wp_customize->add_control( 'header_overlay_opacity', array(
    'type' => 'range',
    'section' => 'soultrust_colors',
    'label' => __( 'Header Overlay Opacity' ),
    // 'description' => __( 'This is the range control description.' ),
    'input_attrs' => array(
      'min' => 0,
      'max' => 1,
      'step' => .1,
    ),
  ));
  $wp_customize->remove_section( 'colors');
}
add_action('customize_register', 'color_customize_register');

// Output Customize CSS
function soultrust_customize_color_css() { ?>
  <style type="text/css">
    body {
      background-color: <?php echo get_theme_mod('base_bg_color') ?>;
      color: <?php echo get_theme_mod('border_text_color') ?>;
      box-shadow: inset 0 0 0 9px <?php echo get_theme_mod('border_text_color') ?>;
    }
    body::before {
      border-color: <?php echo get_theme_mod('border_text_color') ?>;
    }
    body::after {
      background-color: <?php echo get_theme_mod('header_overlay_color') ?>;
      opacity: <?php echo get_theme_mod('header_overlay_opacity') ?>;
    }
    h1 a {
      color: <?php echo get_theme_mod('border_text_color') ?>;
    }
    a:link,
    ul li::before {
      color: <?php echo get_theme_mod('link_color') ?>;
    }
  </style>
<?php }
add_action('wp_head', 'soultrust_customize_color_css');


// add_filter( 'enter_title_here', 'custom_enter_title_text' );

// function custom_enter_title_text( $input ) {
//   if ( 'recipe' === get_post_type() ) {
//       return __( 'Add recipe title', 'wp-rig' );
//   }
//   return $input;
// }


// function change_columns( $cols ) {
//   $cols = array(
//     'title'      => 'Recipe Title'
//   );
//   return $cols;
// }

// add_action("manage_site_posts_custom_column", "custom_columns", 10, 2);
// add_filter("manage_recipe_posts_columns", "change_columns");

/**
 * Adds custom classes to indicate whether a sidebar is present to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Filtered body classes.
 */

// add_filter('body_class', 'filter_body_classes');

// function filter_body_classes( array $classes ) : array {
//     if (is_active_sidebar('sidebar-1')) {
//         global $template;
//         if (! in_array(
//             basename($template),
//             array('single-recipe.php', '404.php', '500.php', 'offline.php')
//         )
//         ) {
//             $classes[] = 'has-sidebar';
//         }
//     }
//     return $classes;
// }

// add_action('admin_enqueue_scripts', 'load_admin_style');

// function load_admin_style()
// {
//     wp_enqueue_style('admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0');
// }


// Redirect subscriber-level members to home page.
// (demo account is a subcriber)
// function redirectToFrontEnd() {
//   $ourCurrentUser = wp_get_current_user();

//   if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
//     wp_redirect(site_url('/'));
//     exit;
//   }
// }
// add_action('admin_init', 'redirectToFrontEnd');

// Redirect everybody to home page after logging in.
// Subsequent visits to admin will not redirect.
// add_filter('login_redirect', 'mylogin_redirect', 10, 3);

// function mylogin_redirect($redirect_to, $url_redirect_to, $user) {
//   return home_url();
// }

// Remove admin bar for subscribers
// add_action('wp_loaded', 'noSubsAdminBar');

// function noSubsAdminBar() {
//   $ourCurrentUser = wp_get_current_user();

//   if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
//     show_admin_bar(false);
//   }
// }

// // Customize Title Link for Login Screen
// add_filter('login_headerurl', 'ourHeaderUrl');

// function ourHeaderUrl() {
//   return esc_url(site_url('/'));
// }

// // Change the Login Page Title
// add_filter('login_headertitle', 'ourLoginTitle');

// function ourLoginTitle() {
//   return get_bloginfo('name');
// }




