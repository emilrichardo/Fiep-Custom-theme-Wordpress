<?php
// ./wp-content/themes/twentyseventeen-child/functions.php
function fiep_styles() { 
    $parent_style = 'parent-style'; 
 
    // encola los estilos del padre.
    wp_enqueue_style( 
    	$parent_style, 
    	get_template_directory_uri() . '/style.css' );
	
    // encola personalizaciones.
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script( 'child-script',   
    get_stylesheet_directory_uri() . '/assets/js/main.js' );
}
add_action( 'wp_enqueue_scripts', 'fiep_styles' ); 

function my_scripts() {
  wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
  //wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.3.1.slim.min.js', array( 'jquery' ),'',true );
 // wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array( 'jquery' ),'',true );
  //wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );
?>

<?php
//oculta post duplicado
add_filter('post_link', 'track_displayed_posts');
add_action('pre_get_posts','remove_already_displayed_posts');
 
$displayed_posts = [];
 
function track_displayed_posts($url) {
  global $displayed_posts;
  $displayed_posts[] = get_the_ID();
  return $url; // don't mess with the url
}
 
function remove_already_displayed_posts($query) {
 global $displayed_posts;
 $query->set('post__not_in', $displayed_posts);
}



/* Custom Post Type Start */
function create_posttype() {
  register_post_type( 'personas',
  // CPT Options
  array(
    'labels' => array(
      'menu_icon'   => 'dashicons-groups',
     'name' => __( 'Personas' ),
     
     'singular_name' => __( 'Persona' )
    ),
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'persona'),
   )
  );
  register_post_type( 'Sponsors',
  // CPT Options
  array(
    'labels' => array(
      'menu_icon'   => 'http://site.com/wp-content/themes/theme_name/i/icon_16x16.png',
     'name' => __( 'Sponsors' ),     
     'singular_name' => __( 'Sponsor' )
    ),
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'sponsor'),
   )
  );
  }
  // Hooking up our function to theme setup
  add_action( 'init', 'create_posttype' );


  // Let us create Taxonomy for Custom Post Type
        add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );
 
        //create a custom taxonomy name it "type" for your posts
        function crunchify_create_deals_custom_taxonomy() {
        
          $labels = array(
            'name' => _x( 'Grupos', 'taxonomy general name' ),
            'singular_name' => _x( 'Grupo', 'taxonomy singular name' ),
            'search_items' =>  __( 'Buscar Grupos' ),
            'all_items' => __( 'Todos los Grupos' ),
            'parent_item' => __( 'Parent Grupo' ),
            'parent_item_colon' => __( 'Parent Grupo:' ),
            'edit_item' => __( 'Editar Grupo' ), 
            'update_item' => __( 'Update Grupo' ),
            'add_new_item' => __( 'Agregar nuevo grupo' ),
            'new_item_name' => __( 'Nuevo Grupo' ),
            'menu_name' => __( 'Grupos' ),
          ); 	
        
          register_taxonomy('grupos',array('personas'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'grupo' ),
          ));
        }
  