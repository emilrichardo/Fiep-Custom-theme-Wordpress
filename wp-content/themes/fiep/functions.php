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
  // wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
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

  register_taxonomy('categoria_cursos', 'cursos', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( 'Categoria de curso', 'taxonomy general name' ),
      'singular_name' => _x( 'Categoría', 'taxonomy singular name' ),
      'search_items' =>  __( 'Buscar categoría' ),
      'all_items' => __( 'Todas las categorias' ),
      'parent_item' => __( 'Parent Advert Tag' ),
      'parent_item_colon' => __( 'Parent Advert Tag:' ),
      'edit_item' => __( 'Editar categoría' ),
      'update_item' => __( 'Actualizar categoría' ),
      'add_new_item' => __( 'Agregar nueva categoría' ),
      'new_item_name' => __( 'Nuevo nombre de categoría' ),
      'menu_name' => __( 'Categoría de curso' ),
    ),
    'rewrite' => array(
      'slug' => 'advert-tags',
      'with_front' => false,
      'hierarchical' => true
    ),
  ));


    }

    add_action( 'init', 'add_custom_taxonomy', 0 );
  

    function create_post_type_cursos() {
      $args=  array(
             'labels'         => array(
              'name'           => __( 'Cursos' ),
              'singular_name'  => __( 'Curso' ),              
               ),
             
             'public'         => true,
             'supports'       => array('title','editor','thumbnail'),
             'menu_position'  => 4,
             'menu_icon'      => 'dashicons-list-view',
             'has_archive' => true,
             'rewrite' => array('slug' => 'cursos'),
             'show_in_rest' => true,
              //'supports' => array('editor')
             
               );
    register_post_type( 'cursos', $args);
  }
     
  
//quita los productos de la categorias Cursos Online
add_action( 'woocommerce_product_query', 'bbloomer_hide_products_category_shop' );
function bbloomer_hide_products_category_shop( $q ) {
	  
		$tax_query = (array) $q->get( 'tax_query' );
	  
		$tax_query[] = array(
			   'taxonomy' => 'product_cat',
			   'field' => 'slug',
			   'terms' => array( 'cursos-online' ), // Category slug here
			   'operator' => 'NOT IN'
		);
		$q->set( 'tax_query', $tax_query );
}  
  

//Quita las categorias de la tienda que no queremos mostrar
add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );
function get_subcategory_terms( $terms, $taxonomies, $args ) {

		$new_terms = array();
		$hide_category = array( 20, 39 ); // ID de las categorias que no queremos que se muestren

		// si es una categoría de producto y en la página de la tienda
		if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && is_shop() ) {
			foreach ( $terms as $key => $term ) {
				if ( ! in_array( $term->term_id, $hide_category ) ) {
					$new_terms[] = $term;
				}
			}
			$terms = $new_terms;
		}
		return $terms;
}
  

// Registra el script para validar el formulario de cheqout
add_action ('wp_enqueue_scripts', 'custom_checkout_validation_scripts');
function custom_checkout_validation_scripts () {
  wp_register_script('miscript', get_stylesheet_directory_uri(). '/assets/js/checkout-validation.js', array('jquery'), '1', true );
  wp_enqueue_script('miscript');
}


// Registra el script para el acordeon
add_action ('wp_enqueue_scripts', 'acordeon_scripts');
function acordeon_scripts () {
  wp_register_script('acordeon', get_stylesheet_directory_uri(). '/assets/js/acordeon.js', array('jquery'), '1', true );
  wp_enqueue_script('acordeon');
}


//Permite fijar un curso dentro de su página a la parte superior
add_filter( 'the_posts', 'wpb_cpt_sticky_at_top' );
function wpb_cpt_sticky_at_top( $posts ) {
  
  // apply it on the archives only
  if ( is_main_query() && is_post_type_archive() ) {
      global $wp_query;

      $sticky_posts = get_option( 'sticky_posts' );
      $num_posts = count( $posts );
      $sticky_offset = 0;

      // Find the sticky posts
      for ($i = 0; $i < $num_posts; $i++) {

          // Put sticky posts at the top of the posts array
          if ( in_array( $posts[$i]->ID, $sticky_posts ) ) {
              $sticky_post = $posts[$i];

              // Remove sticky from current position
              array_splice( $posts, $i, 1 );

              // Move to front, after other stickies
              array_splice( $posts, $sticky_offset, 0, array($sticky_post) );
              $sticky_offset++;

              // Remove post from sticky posts array
              $offset = array_search($sticky_post->ID, $sticky_posts);
              unset( $sticky_posts[$offset] );
          }
      }

      // Look for more sticky posts if needed
      if ( !empty( $sticky_posts) ) {

          $stickies = get_posts( array(
              'post__in' => $sticky_posts,
              'post_type' => $wp_query->query_vars['post_type'],
              'post_status' => 'publish',
              'nopaging' => true
          ) );

          foreach ( $stickies as $sticky_post ) {
              array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
              $sticky_offset++;
          }
      }

  }

  return $posts;
}


// Add sticky class in article title to style sticky posts differently
add_filter('post_class', 'cpt_sticky_class');
function cpt_sticky_class($classes) {
          if ( is_sticky() ) : 
          $classes[] = 'sticky';
          return $classes;
      endif; 
      return $classes;
}
  


  // function my_pre_get_posts( $query ) {
	
  //   // do not modify queries in the admin
  //   // if( is_admin() ) {
  //   //   return $query;
  //   // }
    
  //   // only modify queries for 'cursos' post type
  //   if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'cursos' ) {
  //     // allow the url to alter the query
  //     if(isset($_GET['estado_inscripciones']) ) {
  //       $query->set('meta_key', 'estado_inscripciones');
  //       $query->set('meta_value', $_GET['estado_inscripciones']);
  //     } 
  //   }
  //   // return
  //   return $query;
  // }
  
  // add_action('pre_get_posts', 'my_pre_get_posts');

  // // Permite  filtar los cursos por argumentos
  // function my_posts_where( $where ) {
  //   $where = str_replace("meta_key = 'estado_inscripciones", "meta_key LIKE 'estado_inscripciones%", $where);
  //   return $where;
  // }
  // add_filter('posts_where', 'my_posts_where');

  // array of filters (field key => field name)



// action para busquedas
add_action('pre_get_posts', 'my_pre_get_posts', 10, 1);
function my_pre_get_posts( $query ) {
	
	// bail early if is in admin
	if( is_admin() ) {
    return;
  }
  
  if( !$query->is_main_query() ) {
    return;
  }
  
	// get meta query
	$meta_query = $query->get('meta_query');

  if(isset($_GET['categoria_cursos']) ) {
    $query->set('taxonomy', 'categoria_cursos');
    $query->set('taxonomy', 'slug');
    $query->set('terms', $_GET['categoria_cursos']);
  }

  if(isset($_GET['estado_inscripciones']) ) {
    $query->set('meta_key', 'estado_inscripciones');
    $query->set('meta_value', $_GET['estado_inscripciones']);
  }

  if(isset($_GET['cupos']) ) {
    $query->set('meta_key', 'cupos');
    $query->set('meta_value', $_GET['cupos']);
    $query->set('meta_compare', 'LIKE');
  }
  
  $query->set('meta_query', $meta_query);
  return;
}


// Actualiza automáticamente el estado de PROCESADO a COMPLETADO
// // add_action( 'woocommerce_order_status_on-hold', 'actualiza_estado_pedidos_a_completado' );
add_action( 'woocommerce_order_status_processing', 'actualiza_estado_pedidos_a_completado' );
function actualiza_estado_pedidos_a_completado( $order_id ) {
    global $woocommerce;
    
    //ID's de las pasarelas de pago a las que afecta
    // $paymentMethods = array( 'bacs', 'cheque', 'cod', 'paypal' );
    $paymentMethods = array( 'woo-mercado-pago-basic' );
    
    if ( !$order_id ) return;
    $order = new WC_Order( $order_id );

    if ( !in_array( $order->payment_method, $paymentMethods ) ) return;
    $order->update_status( 'completed' );
}


class Producto
    {
      public $product_name;
      public $product_id;
      public $quantity; 
      public $subtotal;
      
      public function getName()
      {
      return $this->name;
      }
    };
  
class Matricula {
      public $Nombre;
      public $Apellido;
      public $Documento;
      public $Email; 
      public $Productos;
    }

//Agregar contenido en el email de completado
add_action( 'woocommerce_email_before_order_table', 'dl_añadir_contenido_email_woo', 30, 4 ); // En este caso decimos que el cotenido esté antes de la tabla.

function dl_añadir_contenido_email_woo( $order, $sent_to_admin, $plain_text, $email ) {
  //Aqui ponemos el ID del correo que queremos modificar
  if ( $email->id == 'customer_completed_order' ) { 
    echo '<p><h3 style="color: #5570ea; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;">Para iniciar te sugerimos los siguientes tutoriales <br>To start we suggest the following tutorials</h3>'; // Entre las dos p modificamos el mensaje que queremos mostrar
    echo '<ol><li><a href="https://www.youtube.com/watch?v=PW2qaxwKbHA&feature=youtu.be" target="blank">Conociendo el acceso principal del campus</a></li>';
    echo '<li><a href="https://www.youtube.com/watch?v=LSNxzqqRHVI&feature=youtu.be" target="blank">Editar mi perfil</a></li>';
    echo '<li><a href="https://www.youtube.com/watch?v=UvPaGHL5-30&feature=youtu.be" target="blank">Principales herramientas</a></li></ol><br><hr>';
    
    //$order = wc_get_order( $order_id );
    $items = $order->get_items();
    
    $Matricula = new Matricula();

	  $productos = [];
    foreach ( $items as $item ) {
      $producto = new Producto();
      //get id Producto
      $product_id = $item['product_id'];
      //get idCursoMoodle
      $producto->product_id = get_post_meta( $product_id, 'idcursomoodle', true );
      $producto->product_name = $item['name'];
      $producto->subtotal = $item['subtotal'];
      $producto->quantity = $item['quantity'];
      array_push($productos, $producto);
    }
  
    $datos = $order->data;
    $Matricula->Nombre = $datos['billing']['first_name'];
    $Matricula->Apellido = $datos['billing']['last_name'];
    $Matricula->Documento = get_post_meta( $order->get_id(), '_billing_document', true );
    $Matricula->Email = $datos['billing']['email'];
	  $Matricula->Productos = $productos;
    
    $url = 'http://localhost:49220/moodle/procesarInscripcion';
    //$url = 'http://sirwiq.com/Api/Fiep/moodle/procesarInscripcion';
    $ch = curl_init($url);
    $payload = json_encode($Matricula);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    //curl_close($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($httpStatus == 200){
      $data = json_decode($result, true);
      if($data != null && count($data) != 0){
        echo '<h4>'. $data['username'] .' ya te encuentras matriculado en:</h4>';
        echo '<ul>';
        foreach ($Matricula->Productos as $item) {
          echo '<li>' . $item->product_name . '</li>';
        }
        echo '</ul>';
        
        if($data['password'] != null){
          echo "<h2 style='color: #5570ea; display: block; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left;'>";
          echo "<a class='link' href='https://www.fiepargentinaoficial.com/aulavirtual' style='font-weight: normal; text-decoration: underline; color: #5570ea;'>Fiepargentinaoficial.com/aulavirtual</a></h2>";
          echo "<div style='margin-bottom: 40px;''>";
          echo "<table class='td' cellspacing='0' cellpadding='6' border='1' style='color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;'>";
          echo "<thead><tr>" ;
          echo "<th class='td' scope='col' style='color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;'>Usuario/Username</th>";
          echo "<th class='td' scope='col' style='color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; padding: 12px; text-align: left;'>Contraseña/Password</th>";
          echo "</tr></thead><tbody>";
          echo "<tr class='order_item'><td class='td' style='color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap: break-word;'>";
          echo $data['username'] . "</td>";
          echo "<td class='td' style='color: #636363; border: 1px solid #e5e5e5; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;'>";
          echo  $data['password'] . "</td>";
          echo " </tr></tbody></table></div>";
        }
        echo '<hr>';
      }
    }
  }
}


class PreInscripcion {
  public $Email; 
  public $Productos;
}
class ErroresResponse{
        public $Cod;
        public $Mensaje;
        public $Response;
        public $JsonRequest;
        public $JsonResponse;
}
//Valida que el email no se encuentre inscripto en el curso antes
add_action( 'woocommerce_checkout_process', 'action_woocommerce_checkout_process', 10, 1 ); 
function action_woocommerce_checkout_process( $wccs_custom_checkout_field_pro_process ) { 
  $nombre = $_POST['billing_first_name'];
  if($nombre != ''){
	  if(!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $nombre)){
		  wc_add_notice( __('Nombre / First Name  ' . $nombre . ' solo se aceptan letras / only letters are accepted'  ), 'error' );  
	  }
  }

  $apellido = $_POST['billing_last_name'];
  if($apellido != ''){
    if(!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $apellido)){
		  wc_add_notice( __('Apellidos / Last name ' . $apellido . ' solo se aceptan letras / only letters are accepted'  ), 'error' );  
	  }
  }
  
  $documento = $_POST['billing_document'];
  if($documento != ''){
    if(!preg_match("/^(?!-+)[0-9]*$/", $documento)){
		  wc_add_notice( __('Documento / Document ' . $documento . ' solo se aceptan numeros / only numbers are accepted'  ), 'error' );  
	  }
  }
  

  if ( WC()->cart->is_empty() ) {
    wc_add_notice( __( 'Debes tener algun curso en tu pedido.' ), 'error' );
  }else{
    $productos = [];
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ){
      $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $var = $_product->get_categories();
      if($var = 'Cursos Online'){
        $producto = new Producto();
        //get idCursoMoodle
        $producto->product_id = get_post_meta( $_product->get_id(), 'idcursomoodle', true );
        $producto->product_name = $_product->get_name();
        array_push($productos, $producto);
      }
    }

    $emailCliente = $_POST['billing_email'];

    $PreInscripcion = new PreInscripcion();
    $PreInscripcion->Email = $emailCliente;
	  $PreInscripcion->Productos = $productos;

    //$url = 'http://localhost:49220/moodle/procesarPreInscripcion';
    $url = 'http://sirwiq.com/Api/Fiep/moodle/procesarPreInscripcion';
    $ch = curl_init($url);
    $payload = json_encode($PreInscripcion);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    //curl_close($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($httpStatus != 200){
      $deserializedInstance = new ErroresResponse();
      $deserializedInstance = json_decode($response);
      wc_add_notice( __($deserializedInstance->Mensaje  ), 'error' );  
    }
  }
}; 
