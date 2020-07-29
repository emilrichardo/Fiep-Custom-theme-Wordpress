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
  wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
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

function create_post_type_personas() {  
register_post_type( 'personas',
  // CPT Options
  array(
    'labels' => array(
    'add_new'            => _x( 'Añadir nueva', 'persona', 'text-domain' ),
		'add_new_item'       => __( 'Añadir nueva persona', 'text-domain' ),
    'name' => __( 'Personas' ),
    'singular_name' => __( 'Persona' )
    ),
    'public' => true,
    'menu_icon'   => 'dashicons-groups',
    'supports'       => array('title','editor','thumbnail'),
    'has_archive' => false,
    'rewrite' => array('slug' => 'persona'),
    
   )
  );
}

function create_post_type_cursos() {
    $args=  array(
           'labels'         => array(
           'name'           => __( 'Cursos' ),
           'singular_name'  => __( 'Curso' )
             ),
           'public'         => true,
           'supports'       => array('title','editor','thumbnail'),
           'menu_position'  => 4,
           'menu_icon'      => 'dashicons-list-view',
           'has_archive' => true,
             );
  register_post_type( 'cursos', $args);
}
   


// Hooking up our function to theme setup
add_action( 'init', 'create_post_type_personas' );
add_action( 'init', 'create_post_type_cursos' );


// remplazar titulo 
function custom_enter_title( $input ) {
    if ( 'personas' === get_post_type() ) {
        return __( 'Ingresar nombre y apellido', 'your_textdomain' );
    }

    return $input;
}
add_filter( 'enter_title_here', 'custom_enter_title' );

  // Let us create Taxonomy for Custom Post Type
add_action( 'init', 'add_custom_taxonomy', 0 );
function add_custom_taxonomy() {
  register_taxonomy('grupos', 'personas', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( 'Grupo', 'taxonomy general name' ),
      'singular_name' => _x( 'Grupo', 'taxonomy singular name' ),
      'search_items' =>  __( 'Buscar grupo' ),
      'all_items' => __( 'Todos los grupos' ),
      'parent_item' => __( 'Parent Advert Tag' ),
      'parent_item_colon' => __( 'Parent Advert Tag:' ),
      'edit_item' => __( 'Editar grupo' ),
      'update_item' => __( 'Actualizar grupo' ),
      'add_new_item' => __( 'Agregar nuevo grupo' ),
      'new_item_name' => __( 'Nuevo nombre de grupo' ),
      'menu_name' => __( 'Grupos' ),
    ),
    'rewrite' => array(
      'slug' => 'advert-tags',
      'with_front' => false,
      'hierarchical' => true
    ),
  ));
    }
