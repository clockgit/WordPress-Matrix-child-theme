<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'matrix' ), max( $paged, $page ) );
	
	// Get theme options	
	global $smof_data; //fetch options stored in $smof_data

?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="<?php echo $smof_data['matrix_favicon']; ?>" />
<link href="<?php bloginfo( 'stylesheet_url' ); ?>" title="style" rel="stylesheet" type="text/css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( $smof_data['matrix_theme_color_pick_check'] == 0 ) { ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/style-<?php echo $smof_data['matrix_theme_color_select']; ?>.css" title="style" rel="stylesheet" type="text/css" media="screen"/>
<?php } else { ?>
<?php
$theme_colour = $smof_data['matrix_theme_color_pick'];
?>
<style>
a,
.toggle-button:hover,
.ac-tab:hover,
ul#port-filter li,
ul#port-filter li:hover,
.about-person:hover,
.price-pre,
.price-post,
.hl-txt1,
.hl-txt2,
.widget #tweeter li a,
#wp-calendar td#today:hover a,
.woocommerce #content ul.products .add_to_cart_button:hover,
.woocommerce #content ul.products .product_type_grouped:hover,
.woocommerce #content ul.products .product_type_variable:hover,
.woocommerce #content ul.products .product_type_external:hover,
.woocommerce #content ul.products .product_no_stock:hover,
.woocommerce #single .product .single_add_to_cart_button:hover,
.woocommerce div.star-rating:before,
.woocommerce-page div.star-rating:before,
.woocommerce div.star-rating span,
.woocommerce-page div.star-rating span,
.woocommerce #single .product .summary p.price,
.woocommerce #single form.cart .quantity input.minus:hover,
.woocommerce #single form.cart .quantity input.plus:hover,
.woocommerce-page #content #pg-content .quantity input.minus:hover,
.woocommerce-page #content #pg-content .quantity input.plus:hover,
.woocommerce div.pp_woocommerce .pp_arrow_next:hover:before,
.woocommerce div.pp_woocommerce .pp_arrow_previous:hover:before,
header #woocommerce-header-cart .header-cart-link span.quantity .amount,
#content .widget.woocommerce .widget_shopping_cart_content span.quantity .amount,
#content .widget.woocommerce .product_list_widget .amount,
#content .widget.woocommerce .widget_shopping_cart_content .total .amount,
header #woocommerce-header-cart .header-cart li a.remove:hover,
header #woocommerce-header-cart .header-cart-checkout span,
header #woocommerce-header-cart .header-cart-btn:hover,
#content .widget.woocommerce .widget_shopping_cart_content .buttons a.button:hover,
.woocommerce #content .widget.woocommerce.widget_price_filter .price_slider_amount button:hover,
.woocommerce #content .widget.woocommerce.widget_price_filter .price_slider_amount .price_label > span,
.woobutton.checkout-button:hover,
.woobutton.alt:hover,
.woocommerce .cart-collaterals .cart_totals table .total > td, .woocommerce-page .cart-collaterals .cart_totals table .total > td,
#pg-content .woocommerce .checkout #order_review table .total td,
.woocommerce .product-desc-bg .price,
.woocommerce #container nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #container nav.woocommerce-pagination ul li a:hover,
.woocommerce #container #content nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #container #content nav.woocommerce-pagination ul li a:hover,
.woocommerce #container nav.woocommerce-pagination ul li span:hover,
.woocommerce-page #container nav.woocommerce-pagination ul li span:hover,
.woocommerce #container #content nav.woocommerce-pagination ul li span:hover,
.woocommerce-page #container #content nav.woocommerce-pagination ul li span:hover{
	color:<?php echo $theme_colour; ?>;
}
.themecolortxt,
span.dark-themecolor:hover,
#pg-content .about-person:hover h3{
	color:<?php echo $theme_colour; ?> !important;
}
ul#nav li.back,
ul#nav > li li,
.hl1,
.hl3,
#content-title,
.title-highlight,
#content .toggle-content,
.flex-control-paging li a:hover,
.flex-control-paging li a.flex-active,
.page,
.home-pagination,
.nextpagelink,
.table-info ul li,
.woocommerce #content #single .product .woocommerce-tabs,
.woocommerce #single .upsells.products h2,
.woocommerce #single .related.products h2,
header #woocommerce-header-cart .header-cart,
#pg-content .chzn-container-active .chzn-single,
#pg-content .chzn-container .chzn-drop{
	border-color:<?php echo $theme_colour; ?>;
}
.woocommerce .single-product .salebg,
.woocommerce #single .product .salebg,
.woocommerce #content #single div.product .woocommerce-tabs ul.tabs li.active a{
	border-right-color:<?php echo $theme_colour; ?>;
}
.break,
ul#nav li.current-menu-item > a,
ul#nav li.current-post-ancestor > a,
ul#nav li.current-matrix_portfolio-ancestor > a,
ul#nav li li a,
ul#nav:hover > li:hover > a,
.hl2,
.themecolor,
.quote-bg1,
.testimonial-1,
.toggle-button,
.ac-tab,
.flexslider,
.flex-title,
.flex-control-paging li a,
.jp-play-bar,
.jp-volume-bar-value,
.pagination .current,
.post-pagination > .page-numbers,
ul#port-filter li.filter-current,
.table-title,
.widget h5,
#search-field:focus,
#search-submit:hover,
#post-meta .tile-sidebar,
.sidebreak,
span.dark-themecolor,
#wp-calendar td#today,
.img-caption,
.wp-caption-text,
.woocommerce ul.products li.single-product .out-of-stock-text,
header #woocommerce-header-cart:hover,
header #woocommerce-header-cart .cart-counter,
header #woocommerce-header-cart .header-cart li a.remove,
#content .widget.woocommerce .widget_shopping_cart_content .buttons a.button.checkout,
.woobutton.checkout-button,
.woobutton.alt,
.woocommerce-page .woocommerce #respond input#submit.alt, .woocommerce-page .woocommerce a.button.alt, .woocommerce-page .woocommerce button.button.alt, .woocommerce-page .woocommerce input.button.alt,
.woocommerce-page .select2-results .select2-highlighted,
#pg-content .woocommerce table.shop_table thead, .woocommerce-page table.shop_table thead,
#pg-content .chzn-container .chzn-results li:hover, #pg-content .chzn-container .chzn-results li.result-selected, #pg-content .chzn-container .chzn-results:hover li.result-selected:hover, #pg-content .chzn-container .chzn-results .highlighted, #pg-content .chzn-container .chzn-results .no-results,
#pg-content .chzn-container .chzn-results li em,
#pg-content .woocommerce > p.order-info mark{
	background-color:<?php echo $theme_colour; ?>;
}
.woocommerce #content ul.products .add_to_cart_button,
.woocommerce #content ul.products .product_type_grouped,
.woocommerce #content ul.products .product_type_variable,
.woocommerce #content ul.products .product_type_external,
.woocommerce #content ul.products .product_no_stock,
header #woocommerce-header-cart a.header-cart-btn.checkout-btn,
.woocommerce #content .widget.woocommerce.widget_price_filter .price_slider .ui-slider-range,
.woocommerce-page #content #pg-content .quantity input.minus,
.woocommerce-page #content #pg-content .quantity input.plus,
.woocommerce #single form.cart .quantity input.minus,
.woocommerce #single form.cart .quantity input.plus,
.woocommerce #single .product .single_add_to_cart_button,
.woocommerce div.pp_woocommerce .pp_arrow_previous,
.woocommerce div.pp_woocommerce .pp_arrow_next,
.woocommerce div.pp_woocommerce .pp_close,
.woocommerce #container nav.woocommerce-pagination ul li span.current,
.woocommerce-page #container nav.woocommerce-pagination ul li span.current,
.woocommerce #container #content nav.woocommerce-pagination ul li span.current,
.woocommerce-page #container #content nav.woocommerce-pagination ul li span.current,
.woocommerce #content .widget_layered_nav_filters ul li a:hover,
.woocommerce #content ul.products li.product h3 mark, .woocommerce-page #content ul.products li.product h3 mark
{
	background:<?php echo $theme_colour; ?>;
}
</style>
<?php } ?>
<!--[if lt IE 9]>
  <style type="text/css">
  @import url("<?php echo get_template_directory_uri(); ?>/style-ie8.css");
  </style>
  <script>
    document.createElement('header');
    document.createElement('nav');
    document.createElement('section');
    document.createElement('article');
    document.createElement('aside');
    document.createElement('footer');
    document.createElement('hgroup');
    </script>
<![endif]-->
<!--[if IE 9]>
  <style type="text/css">
  @import url("<?php echo get_template_directory_uri(); ?>/style-ie9.css");
  </style>
<![endif]-->
<?php
if ( !empty($smof_data['matrix_woocommerce_atc_button_simple']) ) {
	$wc_atc_simple = $smof_data['matrix_woocommerce_atc_button_simple'];
} else {
	$wc_atc_simple = 80;
}
if ( !empty($smof_data['matrix_woocommerce_atc_button_grouped']) ) {
	$wc_atc_grouped = $smof_data['matrix_woocommerce_atc_button_grouped'];
} else {
	$wc_atc_grouped = 97;
}
if ( !empty($smof_data['matrix_woocommerce_atc_button_external']) ) {
	$wc_atc_external = $smof_data['matrix_woocommerce_atc_button_external'];
} else {
	$wc_atc_external = 98;
}
if ( !empty($smof_data['matrix_woocommerce_atc_button_variable']) ) {
	$wc_atc_variable = $smof_data['matrix_woocommerce_atc_button_variable'];
} else {
	$wc_atc_variable = 98;
}
if ( !empty($smof_data['matrix_woocommerce_atc_button_others']) ) {
	$wc_atc_others = $smof_data['matrix_woocommerce_atc_button_others'];
} else {
	$wc_atc_others = 78;
}

if ( !empty($wc_atc_simple) ) {
?>
<style>
.woocommerce ul.products li.single-product:hover .add_to_cart_button{
	right:-<?php echo $wc_atc_simple; ?>px;
}
.woocommerce ul.products li.single-product:hover .product_no_stock{
	right:-<?php echo $wc_atc_others; ?>px;
}
.woocommerce ul.products li.single-product:hover .product_type_grouped{
	right:-<?php echo $wc_atc_grouped; ?>px;
}
.woocommerce ul.products li.single-product:hover .product_type_variable{
	right:-<?php echo $wc_atc_variable; ?>px;
}
.woocommerce ul.products li.single-product:hover .product_type_external{
	right:-<?php echo $wc_atc_external; ?>px;
}
</style>
<?php } ?>
<script type="text/javascript">
var templateURL = '<?php echo get_template_directory_uri(); ?>';
</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
	matrix_load_scripts();

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<style type="text/css">
body{
	<?php if ( $smof_data['matrix_background_image'] != '' ) { ?>
	background:url(<?php echo $smof_data['matrix_background_image']; ?>) center top no-repeat;
	background-attachment:fixed;
	background-size:cover;
	-moz-background-size:cover;
	-webkit-background-size:cover;
	-o-background-size:cover;
	<?php } else { ?>
	background-color:<?php echo $smof_data['matrix_background_color']; ?>;
	<?php } ?>
}
#logo{
	width:<?php echo $smof_data['matrix_logo_width']; ?>px;
}
#sitename{
	font-size:<?php echo $smof_data['matrix_sitename_size']; ?>;
}
<?php if ( !empty( $smof_data['matrix_custom_css'] ) ) {
	echo $smof_data['matrix_custom_css'];
} ?>
</style>
</head>
<body <?php body_class(); ?>>
<?php if ( $smof_data['matrix_background_pattern'] == 1 ){ ?>
<div id="bodypat">
<?php } ?>
<section id="container" <?php if ( is_plugin_active('woocommerce/woocommerce.php') ) { echo 'class="woocommerce"'; } ?>>
<!-- BEGIN HEADER -->
<header id="siteheader" class="clearfix">
<!-- BEGIN LOGO -->
<a id="headerlink" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img id="logo" src="<?php echo $smof_data['matrix_logo_image']; ?>" alt="logo"/><?php if ( $smof_data['matrix_sitename'] != 0 ){ ?><span id="sitename"><?php if ( $smof_data['matrix_custom_sitename'] != '' ){ echo $smof_data['matrix_custom_sitename']; } else { bloginfo( 'name' ); }?></span><?php } ?></a>
<!-- END LOGO -->

<!-- WOOCOMMERCE CART -->
<?php

if ( is_plugin_active('woocommerce/woocommerce.php') ) {

global $woocommerce;
?>
<div id="woocommerce-header-cart">
	<span class="foundicon-cart"></span>
	<div class="header-cart-wrapper">
	<div class="header-cart">
	<?php

	if (sizeof($woocommerce->cart->cart_contents)>0) {

		echo '<ul class="cart_list">';

		foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {

			$_product = $cart_item['data'];
			if ($_product->exists() && $cart_item['quantity']>0) {
				echo '<li><a href="'.get_permalink($cart_item['product_id']).'">';
				echo '<div class="clearfix">';
				echo $_product->get_image();
				echo '<div class="header-cart-link">';
				echo $_product->get_title();
				echo '<span class="quantity">'.$cart_item['quantity'].' x ';
				echo '<span class="amount">'.woocommerce_price($_product->get_price()).'</span>';
				echo '</span>';
				echo '</div></div>';
				echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
				echo '</a></li>';
			}

		}

    ?>

    <div class="header-cart-checkout">
        <?php _e('Subtotal', 'matrix'); ?><?php echo $woocommerce->cart->get_cart_total(); ?>
    </div>

    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button header-cart-btn view-cart-btn"><?php _e('View Cart', 'matrix'); ?></a>

    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button header-cart-btn checkout-btn"><?php _e('Checkout', 'matrix'); ?></a>

    </ul>

    </div><!-- end .header-cart -->

    <?php 

    	echo '<div class="cart-counter">'.$woocommerce->cart->cart_contents_count.'</div>';

	} else {
    	 echo '<span class="empty">'.__('No products in the cart.','woocommerce').'</span>';
    	 echo '</ul></div>';//end .header-cart
    }
    ?>

    </div><!-- end .header-cart-wrapper -->
</div><!-- end #woocommerce-header-cart -->

<?php } ?>

<!-- BEGIN NAVIGATION -->
<?php wp_nav_menu( array( 
'container'       => 'nav', 
'menu_id'         => 'nav',
'theme_location'  => 'header-menu',
 ) ); ?>
<!-- END NAVIGATION -->

</header>
<!-- END HEADER -->
