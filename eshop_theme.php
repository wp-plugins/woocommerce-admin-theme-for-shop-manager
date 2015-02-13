<?php
/*
Plugin Name: Woocommerce Admin Theme
Plugin URI: http://wordpress.org/plugins/woocommerce-admin-theme-for-shop-manager/
Description: Wordpress Admin Theme to integrate Shop Manager / Merchant Environment. just activate to use this Admin Template.
Author: Balram Singh
Version: 1.0.1
Author URI: http://balramsingh.in
*/
// TO enque custom style sheet for admin Panel

function get_user_role() {
	$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);
}

function wooadmin_my_admin_theme_style() {
	wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'wooadmin_my_admin_theme_style');

add_action('login_enqueue_scripts', 'wooadmin_my_admin_theme_style');

// TO enque custom style sheet for admin Panel

// For Footer content change

add_filter('admin_footer_text', 'wooadmin_left_admin_footer_text_output', 11); //left side

function wooadmin_left_admin_footer_text_output($text) {
    $text = bloginfo('name').' Admin Panel';
    return $text;
}

add_filter('update_footer', 'wooadmin_right_admin_footer_text_output', 11); //right side

function wooadmin_right_admin_footer_text_output($text) {
    $text = 'Version 1.0';
    return $text;
}

// For Footer content change

// To Replace Visit Site in Place of site Name

 add_action( 'admin_head', 'wooadmin_wrap_menu_div_wpse_19814' );

function wooadmin_wrap_menu_div_wpse_19814()
{ 
    ?>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {    
            $('#wp-admin-bar-site-name').each(function()
            {
                $(this).html( '<a class="ab-item balram-singh" class="visit_site" aria-haspopup="true" target="_blank" href="<?php echo home_url(); ?>"><span class="ab-icon icon"></span>Visit Website</a>' );
            });
             $('#wp-admin-bar-comments, #wp-admin-bar-new-content').each(function()
            {
                $(this).html( '' );
            });
        });
		
    </script>
    
    <?php
}
  
// To Replace Visit Site in Place of site Name

// Add Menu Button in Admin Bar

function wooadmin_wp_fluency_admin_bar_unhide_menu() {
	global $wp_admin_bar;
    ?> <span class="unique"><?php $wp_admin_bar->add_menu( array( 'id' => 'wp-eshopbox-messages-menu', 'title' => __('Messages','eshopbox-admin'), 'href' => '#abc', 'meta'=>array('class'=>'unhidden') ) );?> </span><?php
}
//add_action( 'wp_before_admin_bar_render', 'wooadmin_wp_fluency_admin_bar_unhide_menu');

// Add Menu Button in Admin Bar

// Another Method to add custom menu in wordpress header

function wooadmin_eshopbox_admin_bar() {
    global $wp_admin_bar;
    //Add a link called 'My Link'...
    $wp_admin_bar->add_menu( array(
        'id'    => 'my-link',
        'title' => 'My Link',
        'href'  => admin_url()
    ));
}
//add_action( 'wp_before_admin_bar_render', 'wooadmin_eshopbox_admin_bar' ); 

// Another Method to add custom menu in wordpress header

// To Replace Title href of Logo in Admin Panel

 add_action( 'admin_head', 'wooadmin_eshop_admin_logo' );
   
function wooadmin_eshop_admin_logo()
{  
    if( function_exists('get_custom_header') ){
        $width = get_custom_header()->width;
        $height = get_custom_header()->height;
    } else {
        $width = HEADER_IMAGE_WIDTH;
        $height = HEADER_IMAGE_HEIGHT;
    }
    ?>
<style>#wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {content: ' ' !important;}</style>
    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {    
            $('#wp-admin-bar-wp-logo').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<a class="ab-item" aria-haspopup="true" href="<?php echo site_url(); ?>/wp-admin" title="<?php echo bloginfo('name'); ?>"><span class="ab-icon" style="background-image:url(<?php echo header_image(); ?>)!important;width:<?php echo $width ?>px;height:<?php echo $height; ?>px;"></span></a>');
            });
        });
    </script>
    <?php
}

// To Replace Visit Site in Place of site Name

// To Replace Header Top Right Menus in Admin Panel

add_action( 'admin_head', 'wooadmin_eshop_header_right_menus' );

function wooadmin_eshop_header_right_menus()
{   
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {    
            $('#wp-admin-bar-top-secondary').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<li id="wp-admin-bar-logout" class="menupop"><a class="ab-item" aria-haspopup="true" href="<?php echo wp_logout_url( home_url() ); ?>/wp-admin" title="Logout"><span class="ab-logout ab-icon icon"></span>Logout</a></li>          <li id="wp-admin-bar-settings" class="menupop"><a class="ab-item" aria-haspopup="true" href="<?php echo site_url(); ?>/wp-admin/admin.php?page=wc-settings"><span class="ab-settings ab-icon icon"></span>Settings</a></li><li id="wp-admin-bar-messages" class="menupop"><a class="ab-item" aria-haspopup="true" href="<?php echo site_url(); ?>/wp-admin/edit-comments.php"><span class="ab-message ab-icon icon"></span>Messages</a></li>');
            });
            $('#add-new-user').each(function()
            {
                old_value = $(this).html();
                $(this).html( 'Add New Customer');
            });
        });
    </script>
    <?php
}

// To Replace Header Top Right Menus in Admin Panel

// CUSTOMIZE ADMIN MENU ORDER

   function wooadmin_custom_menu_order($menu_ord) {
       if (!$menu_ord) return true;
       return array(
        'index.php', // the dashboard link
        'separator1', // First separator 
        'edit.php?post_type=shop_order', // order menu
        'users.php', //users
        'edit.php?post_type=product', // products or catalogue
        'separator2', // Second separator
        'edit.php?post_type=shop_coupon', // coupons
        'wpseo_dashboard', // SEO
        'separator3', // Third separator
        'edit.php?post_type=page', // pages
        'upload.php', // Media
        'edit.php', //the posts or Blog Menu
        'link-manager.php', // links menu 
        'separator4', // Fourth separator
        'widgets.php', // Widgets menu  
        'nav-menus.php', // menus
        'themes.php?page=custom-header', // header menu
        'themes.php?page=custom-background', // background menu
        'separator5', // Fifth separator     
        'plugins.php', //plugin   
    );
   }
   add_filter('custom_menu_order', 'wooadmin_custom_menu_order');
   add_filter('menu_order', 'wooadmin_custom_menu_order');
// CUSTOMIZE ADMIN MENU ORDER
//Replaces wp-admin menu item names
   // echo admin_url()."admin.php?page=cat_reports";
   if ( isset($_GET['page']) ) {
    $plugin_page = stripslashes($_GET['page']);
    //echo $plugin_page;
   if($plugin_page=='woocommerce_reports' && $plugin_page=='woocommerce_reports'){
    //echo $plugin_page;
   }}
   else{
add_filter('gettext', 'wooadmin_rename_admin_menu_items');
add_filter('ngettext', 'wooadmin_rename_admin_menu_items');

function wooadmin_rename_admin_menu_items( $menu ) {
    // $dxsitename = bloginfo('name');
    // $menu = str_ireplace( 'original name', 'new name', $menu );
    $menu = str_ireplace( 'Woocommerce', 'My Shop', $menu );
    // return $menu array
    return $menu;
}
}
//Replaces wp-admin menu item names

// To Put text in seperator sidebar menu

 add_action( 'admin_head', 'wooadmin_eshop_seperator_text' );

function wooadmin_eshop_seperator_text()
{   
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) 
        {    
            $('.wp-menu-separator').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<div class="seperator_text">eCommerce Management</div><div class="separator"></div>');
            });
			$('.wp-menu-separator1').each(function()
			{
                old_value = $(this).html();
                $(this).html( '<div class="seperator_text">Marketing Suite</div><div class="separator"></div>');
            });
            $('.wp-menu-separator2').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<div class="seperator_text">Content Management</div><div class="separator"></div>');
            });
            $('.wp-menu-separator3').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<div class="seperator_text">Website Design</div><div class="separator"></div>');
            });
            $('.wp-menu-separator4').each(function()
            {
                old_value = $(this).html();
                $(this).html( '<div class="seperator_text">My Shop Extend</div><div class="separator"></div>');
            });
            $('.users-php #username').each(function()
            {
                old_value = $(this).html();
                 $(this).html( '<a href="http://localhost/storeadmin/eshopbox/wp-admin/users.php?orderby=login&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a>');
            });
            $('.users-php .manage-column.column-username.sortable.desc').each(function()
            {
                old_value = $(this).html();
                 $(this).html( '<a href="http://localhost/storeadmin/eshopbox/wp-admin/users.php?orderby=login&amp;order=asc"><span>Email</span><span class="sorting-indicator"></span></a>');
            });
            $('#toplevel_page_woocommerce').each(function()
            {
                old_value = $(this).html();
                 $(this).html( '');
            });
            $('.toplevel_page_wpseo_dashboard #wpseo-title').each(function()
            {
                old_value = $(this).html();
                 $(this).html( 'SEO Suite: General Settings');
            });
            $('.seo_page_wpseo_titles #wpseo-title').each(function()
            {
                old_value = $(this).html();
                 $(this).html( 'SEO Suite: Titles & Metas');
            });
              $('.seo_page_wpseo_social #wpseo-title').each(function()
            {
                old_value = $(this).html();
                 $(this).html( 'SEO Suite: Social');
            });
            $('#toplevel_page_wpseo_dashboard .wp-menu-name').each(function()
            {
                old_value = $(this).html();
                 $(this).html( 'SEO Suite');
            });
            $('#wpseo_meta h3.hndle').each(function()
            {
                old_value = $(this).html();
                 $(this).html( 'SEO Information');
            });
            $('#mainform').each(function()
            {
                $('#mainform h3').prepend('Settings &raquo; ');
                old_value = $(this).html();
                 // $(this).html( 'SEO Information');
            });
            $('.screen-reader-text').each(function()
            {
               // $('#mainform h3').prepend('Settings &raquo; ');
                old_value = $(this).html();
                  $(this).html( '');
            });
            $('#woocommerce_extensions').each(function()
            {
                old_value = $(this).html();
                $(this).html( '');
            });
             $('.edit-comments-php .wrap h2').each(function()
            {
                old_value = $(this).html();
                $(this).html( 'Messages');
            });
              $('.edit-comments-php .wrap .manage-column.column-comment').each(function()
            {
                old_value = $(this).html();
                $(this).html( 'Messages');
            });
              $('.comment-php .wrap h2').each(function()
            {
                old_value = $(this).html();
                $(this).html( 'Edit Message');
            });
            $('.woocommerce_page_woocommerce_settings .nav-tab-wrapper.woo-nav-tab-wrapper').each(function()
            {
                old_value = $(this).html();
               $(this).html( '');
            });
            $('.icon32-woocommerce-settings').each(function()
            {
                old_value = $(this).html();
                $(this).html( '');
            });
        });
    </script>
    <?php
}

// To Put text in seperator sidebar menu

// Rename Users to Customers

function wooadmin_renameuser() {  
    global $menu;  
    global $submenu;  
    $menu[70][0] = 'Customers'; // Change Users to Customers main id
    $submenu['users.php'][5][0] = 'All Customers';  
    $submenu['users.php'][10][0] = 'Add a Customer';  
    $submenu['users.php'][15][0] = 'Admin Profile'; 
    $submenu[ 'index.php' ][1] = array( __('New'), 'read', 'edit.php?post_type=shop_order' );
    // to override SEO menu to Seo Suite
           // add_menu_page( __( 'WordPress SEO Configuration', 'wordpress-seo' ), __( 'SEO Suite', 'wordpress-seo' ), 'manage_options', 'wpseo_dashboard', array( $this, 'config_page' ), WPSEO_URL . 'images/yoast-icon.png' );
            // to override SEO menu to Seo Suite
}  

add_action( 'admin_menu', 'wooadmin_renameuser' );  

// Rename Users to Customers

// Rename Appearence to Website Design

function wooadmin_appearence2website_design() {  
    global $menu;  
    global $submenu;  
    $menu[60][0] = 'Design'; // Change Users to Customers main id
    $submenu['users.php'][5][0] = 'All Customers';  
    $submenu['users.php'][10][0] = 'Add a Customer';  
    $submenu['users.php'][15][0] = 'Admin Profile'; 
    $submenu[ 'index.php' ][1] = array( __('New'), 'read', 'edit.php?post_type=shop_order' );
}  

add_action( 'admin_menu', 'wooadmin_appearence2website_design' ); 

// Rename Appearence to Website Design

// Rename Post to Blog

function wooadmin_rename_post_menu() {  
    global $menu;  
    global $submenu;  
    $menu[5][0] = 'Blog'; // Change Users to Customers main id
    $submenu['edit.php'][5][0] = 'Posts';  
    $submenu['edit.php'][10][0] = 'Add a Customer';  
    $submenu['edit.php'][15][0] = 'Blog Categories'; 
    $submenu['edit.php'][16][0] = 'Blog Tags'; 
}  

add_action( 'admin_menu', 'wooadmin_rename_post_menu' );  

// Rename Post to Blog

// Rename Post to Blog

function wooadmin_rename_product_menu() {  
    global $menu;  
    global $submenu;  
    $menu[20][0] = 'Catalogue'; // Change Users to Customers main id
    $submenu['edit.php?post_type=product'][5][0] = 'Posts';  
    $submenu['edit.php?post_type=product'][10][0] = 'Add a Customer';  
    $submenu['edit.php?post_type=product'][15][0] = 'Blog Categories'; 
    $submenu['edit.php?post_type=product'][16][0] = 'Blog Tags'; 
}  

add_action( 'admin_menu', 'wooadmin_rename_post_menu' );  

// Rename Post to Blog

// Rename Plugins to Apps Store and prevent shopkeeper to access plugins page

function wooadmin_rename_plugin_menu() {  
    global $menu;  
    global $submenu;       
    $menu[65][0] = 'Apps Store'; // Change Users to Customers main id
    $submenu['plugins.php'][5][0] = 'Plugin List';  
    $submenu['plugins.php'][10][0] = 'Add a App';  
    $submenu['plugins.php'][15][0] = 'Edit Applications';    
    if (!current_user_can('add_users') ) {
        remove_menu_page('plugins.php');
        remove_menu_page('tools.php'); // Remove the Tools Menu  
        remove_menu_page('edit-comments.php'); // Remove the Tools Menu  
        remove_menu_page( 'mt-top-level-handle' );
        remove_menu_page( 'options-general.php' );
 //echo 'Shop Manager can not use plugins menu';
}
}  

add_action( 'admin_menu', 'wooadmin_rename_plugin_menu' );  

// Rename Plugins to Apps Store

//  Remove Unused Menus

function wooadmin_remove_unused_menu() {  
    global $menu;  
    global $submenu;
    remove_submenu_page('index.php','update-core.php'); // Remove the Home Sub Menu Update 
    remove_submenu_page('edit.php','post-new.php'); // Remove the Add Post Sub Menu From Post Parent Menu
    remove_submenu_page('plugins.php','plugin-install.php'); // Remove the Add Plugin Sub Menu From Plugin Parent Menu
    remove_submenu_page('edit.php?post_type=page','post-new.php?post_type=page'); // Remove the Add Page and All Pages Sub Menu 
    remove_submenu_page('upload.php','media-new.php'); // Remove the Add Media Sub Menu From Media Parent Menu
    remove_submenu_page('link-manager.php','link-add.php'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('link-manager.php','edit-tags.php?taxonomy=link_category'); // Remove the Link Categories Sub Menu From Link Parent Menu
    remove_submenu_page('edit.php?post_type=product','post-new.php?post_type=product'); // Remove the Add Product Sub Menu From Products Menu
    remove_menu_page('edit.php?post_type=product'); // Remove the Products Menu  
    remove_submenu_page('users.php','profile.php'); // Remove the Add Link Sub Menu From Links Parent Menu
    //remove_menu_page('edit.php?post_type=shop_order'); // Remove the Woocommerce Menu 
       // remove_menu_page( 'themes.php' );
   //  remove_submenu_page('edit.php?post_type=shop_order','?page=woocommerce_reports'); // Remove the Tools Menu
    // remove_menu_page('admin.php?page=woocommerce_reports'); // Remove the Tools Menu  
    // remove_menu_page('edit.php?post_type=shop_coupon'); // Remove the Tools Menu  
    // remove_menu_page('admin.php?page=woocommerce_settings'); // Remove the Tools Menu  
    remove_submenu_page('wpseo_dashboard','wpseo_rss'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('wpseo_dashboard','wpseo_import'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('wpseo_dashboard','wpseo_files'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('wpseo_dashboard','wpseo_xml'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('wpseo_dashboard','wpseo_permalinks'); // Remove the Add Link Sub Menu From Links Parent Menu
    remove_submenu_page('wpseo_dashboard','wpseo_internal-links'); // Remove the Add Link Sub Menu From Links Parent Menu
} 

add_action( 'admin_menu', 'wooadmin_remove_unused_menu' );  

//  Remove Unused Menus

// To add Submenu REports under Dashboard Sub Menu

// To add Orders as main menu after dasboard

function wooadmin_dasboard_sub_menu() {  
    global $menu; 
    global $submenu; 
    $menu[6] = array( __('Orders'), 'read', 'edit.php?post_type=shop_order', '', 'menu-top menu-top-first menu-icon-orders', 'menu-users', 'none' );
    $menu[7] = array( __('Catalogue'), 'read', 'edit.php?post_type=product', '', 'menu-top menu-top-first menu-icon-catalogue', 'menu-users', 'none' );
    $menu[8] = array( __('Coupons'), 'read', 'edit.php?post_type=shop_coupon', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );
    $menu[61] = array( __('Widgets'), 'read', 'widgets.php', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );
    $menu[62] = array( __('Menus'), 'read', 'nav-menus.php', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );
    $menu[63] = array( __('Header'), 'read', 'themes.php?page=custom-header', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );
    $menu[64] = array( __('Background'), 'read', 'themes.php?page=custom-background', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );
    $menu[66] = array( __('Mailchimp Setup'), 'read', 'options-general.php?page=mailchimpSF_options', '', 'menu-top menu-top-first menu-icon-coupon', 'menu-users', 'none' );    
    $menu[4] = array( '', 'read', 'separator1', '', 'wp-menu-separator','accord' );
    $menu[59] = array( '', 'read', 'separator2', '', 'accord wp-menu-separator1','accord' );
    $menu[99] = array( '', 'read', 'separator3', '', 'wp-menu-separator2', 'accord' );
    $menu[56] = array( '', 'read', 'separator4', '', 'wp-menu-separator3','accord' );
    $menu[57] = array( '', 'read', 'separator5', '', 'wp-menu-separator4','accord' );
    $submenu[ 'index.php' ][1] = array( __('Reports'), 'read', 'admin.php?page=woocommerce_reports' );
}  

add_action( 'admin_menu', 'wooadmin_dasboard_sub_menu' );  

// To add Submenu Orders under Dashboard Sub Menu

// To add Orders as main menu after dasboard

// To remove Color Scheme in User Profile

function wooadmin_admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}

add_action('admin_head', 'wooadmin_admin_color_scheme');

// To remove Color Scheme in User Profile

// to hide screen options in dashboard

//add_filter('screen_options_show_screen', '__return_false');

function wooadmin_remove_dashboard_widgets(){
    remove_meta_box('posts', 'users', 'normal');   // Right Now
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('welcome-panel', 'dashboard', 'normal'); // Welcome Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News

// use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.

}

add_action('wp_dashboard_setup', 'wooadmin_remove_dashboard_widgets');

// Remove Biographical Info From users Page

 add_action( 'personal_options', array ( 'wooadmin_T5_Hide_Profile_Bio_Box', 'start' ) );

/**
 * Captures the part with the biobox in an output buffer and removes it.
 */

class wooadmin_T5_Hide_Profile_Bio_Box
{
    /**
     * Called on 'personal_options'.
     *
     * @return void
     */
    public static function start()
    {
        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
        add_action( $action, array ( __CLASS__, 'stop' ) );
        ob_start();
    }
    /**
     * Strips the bio box from the buffered content.
     *
     * @return void
     */
    public static function stop()



    {
        $html = ob_get_contents();
        ob_end_clean();
        // remove the headline

        $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        $html = str_replace( '<h3>' . $headline . '</h3>', '', $html );

        // remove the table row

        $html = preg_replace( '~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html );
        print $html;
    }
}
// Remove Biographical Info From users Page

// Remove Role, Email and Posts from All Users Page In Admin Panel

function wooadmin_my_remove_columns( $posts_columns ) {
    unset( $posts_columns['role'] );
    unset( $posts_columns['email'] );
    unset( $posts_columns['posts'] );
    unset( $posts_columns['posts'] );
    return $posts_columns;
}

add_filter( 'manage_users_columns', 'wooadmin_my_remove_columns' );

// Remove Role, Email and Posts from All Users Page In Admin Panel

// Remove Role, Email and Posts from All Users Page In Admin Panel

// add_filter first parameter is manage then url of page then columns then columns

function wooadmin_my_remove_columns1( $posts_columns ) {
    unset( $posts_columns['author'] );
    unset( $posts_columns['email'] );
    unset( $posts_columns['posts'] );
    unset( $posts_columns['posts'] );
    return $posts_columns;
}

add_filter( 'manage_edit-comments_columns', 'wooadmin_my_remove_columns1' );

// Remove Role, Email and Posts from All Users Page In Admin Panel

// add_filter first parameter is manage then url of page then columns then columns

// Remove Social Links In user Page

function wooadmin_remove_contactmethods($contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['website']);
  unset($contactmethods['yim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['googleplus']);
  unset($contactmethods['twitter']);
  unset($contactmethods['url']);
  return $contactmethods;
}

add_filter( 'user_contactmethods', 'wooadmin_remove_contactmethods' );

// Remove Social Links In user Page

// removes the `profile.php` admin color scheme options

remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

if ( ! function_exists( 'cor_remove_personal_options' ) ) {

//   * Removes the leftover 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options

  function cor_remove_personal_options( $subject ) {
    $subject = preg_replace( '#<h3>Personal Options</h3>.+?/table>#s', '', $subject, 1 );
    return $subject;
  }

  function wooadmin_cor_profile_subject_start() {
    ob_start( 'cor_remove_personal_options' );
  }

  function wooadmin_cor_profile_subject_end() {
    ob_end_flush();
  }
}

add_action( 'admin_head-profile.php', 'wooadmin_cor_profile_subject_start' );

add_action( 'admin_footer-profile.php', 'wooadmin_cor_profile_subject_end' );

// removes the `profile.php` admin color scheme options

// remove all the items under “Personal Options” on user profile page

add_action( 'admin_print_styles-profile.php', 'wooadmin_remove_profile_fields' );

add_action( 'admin_print_styles-user-edit.php', 'wooadmin_remove_profile_fields' );

function wooadmin_remove_profile_fields( $hook ) {
    ?>
    <style type="text/css">
        form#your-profile p+h3,
        form#your-profile p+h3+table { display:none!important;visibility:hidden!important; }
    </style>
    <?php
} 

// remove all the items under “Personal Options” on user profile page

//Hiding Upgrade Notices

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

//Hiding Upgrade Notices

// Remove Help tabs on wordpress

add_action('admin_head', 'wooadmin_mytheme_remove_help_tabs');

function wooadmin_mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
     remove_menu_page('edit-comments.php'); // Remove the Tools Menu  
    remove_menu_page('update-core.php'); // Remove the Tools Menu  
}

// Remove Help tabs on wordpress

// Disable the “please upgrade now” message
      add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
      add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
// Disable the “please upgrade now” message

// Remove Notices in wordpress

add_action('admin_menu','wooadmin_bhhidenag');

function wooadmin_bhhidenag()
{
   remove_action( 'admin_notices', 'update_nag', 3 );
}

// Remove Notices in wordpress

function wooadmin_my_custom_userfields( $contactmethods ) {
    //Adds customer contact details
    $contactmethods['company_name'] = 'Customer Note';
    return $contactmethods;
   }

add_filter('user_contactmethods','wooadmin_my_custom_userfields',10,1);

function wooadmin_hack_add_custom_user_profile_fields(){
    global $pagenow;
    # do this only in page user-new.php
    if($pagenow !== 'user-new.php')
        return;
    # do this only if you can
    if(!current_user_can('manage_options'))
        return false;
?>
<table id="table_my_custom_field" style="display:none;">
<!-- My Custom Code { -->
    <tr>
        <th><label for="my_custom_field">My Custom Field</label></th>
        <td><input type="text" name="my_custom_field" id="my_custom_field" /></td>
    </tr>
<!-- } -->
</table>
<script>
jQuery(function($){
    //Move my HTML code below user's role
    $('#table_my_custom_field tr').insertAfter($('#role').parentsUntil('tr').parent());
});
</script>

<?php
}
//add_action('admin_footer_text', 'wooadmin_hack_add_custom_user_profile_fields');

function wooadmin_save_custom_user_profile_fields($user_id){
    # again do this only if you can
    if(!current_user_can('manage_options'))
        return false;
    # save my custom field
    update_usermeta($user_id, 'my_custom_field', $_POST['my_custom_field']);
}
add_action('user_register', 'wooadmin_save_custom_user_profile_fields');

// Relpace customer from users heading and title
add_filter( 'gettext', 'wooadmin_change_post_to_article1' );
add_filter( 'ngettext', 'wooadmin_change_post_to_article1' );

function wooadmin_change_post_to_article1( $translated ) 
{  
    $translated = str_replace( 'Users', 'Customers', $translated );
    $translated = str_replace( 'Edit User', 'Edit Customer', $translated );
    return $translated;
}

// Relpace customer from users heading and title

// To replace settings sub menus on click of settings in header

function wooadmin_remove_menus () {
if($_GET['page']!='woocommerce_settings' && $_GET['page']!='woocommerce_settings'){    // echo 'test';
}
else{
    // echo "else part correct";
    remove_menu_page( 'index.php' );
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'link-manager.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'plugins.php' );
    remove_menu_page( 'users.php' );
    remove_menu_page( 'options-general.php' );
    remove_menu_page( 'upload.php' );
    remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit.php?post_type=page' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'edit.php?post_type=shop_order' );
    remove_menu_page( 'edit.php?post_type=product' );
    remove_menu_page( 'edit.php?post_type=shop_coupon' );
    remove_menu_page( 'wpseo_dashboard' );
    remove_menu_page( 'edit.php?post_type=slide' );
    remove_menu_page( 'wpcf7' );
    remove_menu_page( 'my-posts-order' );
    remove_menu_page( 'private_blog_settings' );
    remove_menu_page( 'edit.php?post_type=shop_order' );
    remove_menu_page( 'widgets.php' );
    remove_menu_page( 'nav-menus.php' );
    remove_menu_page( 'themes.php?page=custom-header' );
    remove_menu_page( 'themes.php?page=custom-background' );
   // remove_menu_page( 'mt-top-level-handle' );

//Remove sub level admin menus
    remove_submenu_page( 'themes.php', 'themes.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
    remove_submenu_page( 'edit.php', 'post-new.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-install.php' );
    remove_submenu_page( 'users.php', 'users.php' );
    remove_submenu_page( 'users.php', 'user-new.php' );
    remove_submenu_page( 'upload.php', 'media-new.php' );
    remove_submenu_page( 'options-general.php', 'options-writing.php' );
    remove_submenu_page( 'options-general.php', 'options-discussion.php' );
    remove_submenu_page( 'options-general.php', 'options-reading.php' );
    remove_submenu_page( 'options-general.php', 'options-discussion.php' );
    remove_submenu_page( 'options-general.php', 'options-media.php' );
    remove_submenu_page( 'options-general.php', 'options-privacy.php' );
    remove_submenu_page( 'options-general.php', 'options-permalinks.php' );
    remove_submenu_page( 'index.php', 'update-core.php' );
    remove_submenu_page( 'edit.php?post_type=shop_order', 'edit.php?post_type=shop_order' );
    remove_submenu_page( 'edit.php?post_type=shop_order', 'woocommerce_reports' );
    remove_submenu_page( 'edit.php?post_type=shop_order', 'edit.php?post_type=shop_coupon' );
    remove_submenu_page( 'edit.php?post_type=shop_order', 'woocommerce_settings' );
    remove_submenu_page( 'edit.php?post_type=shop_order', 'woocommerce_status' );
    remove_submenu_page( 'index.php', 'admin.php?page=woocommerce_reports' );
    remove_submenu_page( 'index.php', 'index.php' );
    remove_submenu_page( 'index.php', 'admin.php?page=woocommerce_reports' );

    global $menu; 

    global $submenu; 

    $menu[100] = array( __('Back to Dashboard'), 'read', 'index.php', '', 'menu-top menu-top-first back_to', '', 'none' );
    $menu[6] = array( __('General'), 'read', 'admin.php?page=woocommerce_settings&tab=general', '', 'menu-top menu-top-first menu-icon-dashboard', 'menu-dashboard', 'none' );
    $menu[7] = array( __('Catalogue'), 'read', 'admin.php?page=woocommerce_settings&tab=catalog', '', 'menu-top menu-top-first menu-icon-catalogue', 'menu-dashboard', 'none' );
    //$menu[8] = array( __('Pages'), 'read', 'admin.php?page=woocommerce_settings&tab=pages', '', 'menu-top menu-top-first menu-icon-page', 'menu-dashboard', 'none' );
    $menu[9] = array( __('Inventory'), 'read', 'admin.php?page=woocommerce_settings&tab=inventory', '', 'menu-top menu-top-first menu-icon-post', 'menu-dashboard', 'none' );
    $menu[19] = array( __('Tax'), 'read', 'admin.php?page=woocommerce_settings&tab=tax', '', 'menu-top menu-top-first menu-icon-tax', 'menu-dashboard', 'none' );
    $menu[40] = array( __('Shipping'), 'read', 'admin.php?page=woocommerce_settings&tab=shipping', '', 'menu-top menu-top-first menu-icon-shipping', 'menu-dashboard', 'none' );
    $menu[41] = array( __('Payment Gateways'), 'read', 'admin.php?page=woocommerce_settings&tab=payment_gateways', '', 'menu-top menu-top-first menu-icon-payment', 'menu-dashboard', 'none' );
    $menu[42] = array( __('Emails'), 'read', 'admin.php?page=woocommerce_settings&tab=email', '', 'menu-top menu-top-first menu-icon-mail', 'menu-dashboard', 'none' );
    $menu[43] = array( __('Integration'), 'read', 'admin.php?page=woocommerce_settings&tab=integration', '', 'menu-top menu-top-first menu-icon-integration', 'menu-dashboard', 'none' );
    $menu[44] = array( __('PIP Settings'), 'read', 'admin.php?page=woocommerce_pip', '', 'menu-top menu-top-first menu-icon-integration', 'menu-dash', 'none' );
}
}
  add_action('admin_menu', 'wooadmin_remove_menus');

function wooadmin_abc(){
   $admin_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212;' ),get_admin_page_title() , $admin_title );
   $admint = sprintf( __( '%1$s &lsaquo; %2$s &#8212;My Shop' ),get_bloginfo( 'name' ) , $admin_title );
  // $admint = sprintf( __( '%1$s &lsaquo; %2$s &#8212;My Shop' ), $admin_title, $admin_title );
   $title = get_admin_page_title();
   $title = esc_html( strip_tags( $title ) );
  //  $admin_title = sprintf( __( '%1$s &#8212; My Shop' ), $title );
    $admin_title = get_bloginfo( 'name' );
 $admint = sprintf( __( '%1$s &lsaquo; %2$s &#8212; My Shop' ), $title, $admin_title );
   return  $admint ;

// Start Here

   return get_admin_page_title().'--'.get_bloginfo( 'name' ).'--'.'eshopbox';
 $title = esc_html( strip_tags( $title ) );
 if ( is_network_admin() )
     $admin_title = __( 'Network Admin' );
 elseif ( is_user_admin() )
     $admin_title = __( 'Global Dashboard' );
 else
     $admin_title = get_bloginfo( 'name' );
 if ( $admin_title == $title )
     $admin_title = sprintf( __( '%1$s &#8212; WordPress' ), $title );
 else
     $admin_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $admin_title );
 $admin_title = apply_filters( 'admin_title', $admin_title, $title );
 return $admin_title;
// End Here
}
// To replace settings sub menus on click of settings in header
add_filter( 'admin_title', 'wooadmin_abc', 20 );
// title of admin pages wordpress remove_dashboard_widgets
// Remove plugin update notification
remove_action( 'load-update-core.php', 'wp_update_plugins' );

add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

// Remove plugin update notification



 // Hide the WordPress Upgrade Message in the Dashboard

add_action('admin_menu','wooadmin_wphidenag');

function wooadmin_wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}

// Hide the WordPress Upgrade Message in the Dashboard
//Hide WpAdmin Bar from the website when the user/ shopmanager is loggedin

add_filter('show_admin_bar', '__return_false');  

//Hide WpAdmin Bar from the website when the user/ shopmanager is loggedin
// Hide Woocommerce Pages From The Dashboard 
add_action( 'pre_get_posts' ,'wooadmin_exclude_this_page' );
function wooadmin_exclude_this_page( $query ) {
    if( !is_admin() )
        return $query;
    global $pagenow;
    // WordPress 2.9
    // if( 'edit-pages.php' == $pagenow )
    //     $query->set( 'post__not_in', array(9) );
    // WordPress 3.0
    $bal = get_option(' woocommerce_myaccount_page_id ');
    $bal1 = get_option('woocommerce_shop_page_id');
    $bal2 = get_option('woocommerce_cart_page_id');
    $bal3 = get_option(' woocommerce_pay_page_id ');
    $bal4 = get_option(' woocommerce_thanks_page_id ');
    $bal5 = get_option(' woocommerce_edit_address_page_id ');
    $bal6 = get_option(' woocommerce_view_order_page_id '); 
    $bal7 = get_option(' woocommerce_terms_page_id ');
    $bal8 = get_option('woocommerce_checkout_page_id'); 
    $bal9 = get_option('woocommerce_change_password_page_id'); 
    $bal10 = get_option('woocommerce_lost_password_page_id'); 
    $bal11 = get_option('woocommerce_logout_page_id'); 
    if( 'edit.php' == $pagenow && ( get_query_var('post_type') && 'page' == get_query_var('post_type') ) )
        $query->set( 'post__not_in', array($bal, $bal1, $bal1, $bal2, $bal3, $bal4, $bal5, $bal6, $bal7, $bal8, $bal9, $bal10, $bal11) );
    return $query;
}

// Hide Woocommerce Pages From The Dashboard 
// to hide wordpress version like we see meta ="generator" and wordpress version in view code

remove_action('wp_head', 'wp_generator');

// to hide wordpress version like we see meta ="generator" and wordpress version in view code
// Remove Screen Header Tab

add_filter('screen_options_show_screen', '__return_false');

// Remove Screen Header Tab
// romove welcome message from wordpress dashboard

add_action( 'load-index.php', 'wooadmin_remove_welcome_panel' );
function wooadmin_remove_welcome_panel()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
    $user_id = get_current_user_id();
    if (0 !== get_user_meta( $user_id, 'show_welcome_panel', true ) ) {
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
    }
}
// romove welcome message from wordpress dashboard
// Force one column layout page in screen options in wordpress admin page

function wooadmin_so_screen_layout_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'wooadmin_so_screen_layout_columns' );
function wooadmin_so_screen_layout_dashboard() {
    return 1;
}
add_filter( 'get_user_option_screen_layout_dashboard', 'wooadmin_so_screen_layout_dashboard' );

// Force one column layout page in screen options in wordpress admin page
//Seo plugin
// @to do general title page only for admin
/**
* To change Woocommerce Settings from Woocommerce Settings Page Title
*/
remove_action('admin_menu', 'woocommerce_admin_menu_after', 50);
function wooadmin_woocommerce_admin_menu_after1() {
    $settings_page = add_submenu_page( 'woocommerce', __( 'My Shop Settings Page', 'woocommerce' ),  __( 'Settings', 'woocommerce' ) , 'manage_woocommerce', 'woocommerce_settings', 'woocommerce_settings_page');
    $status_page = add_submenu_page( 'woocommerce', __( 'WooCommerce Status', 'woocommerce' ),  __( 'System Status', 'woocommerce' ) , 'manage_woocommerce', 'woocommerce_status', 'woocommerce_status_page');
    add_action( 'load-' . $settings_page, 'woocommerce_settings_page_init' );
}
add_action('admin_menu', 'wooadmin_woocommerce_admin_menu_after1', 50);

// To change href link and title of admin theme login screen

add_filter( 'login_headerurl', 'wooadmin_namespace_login_headerurl' );

/**
 * Replaces the login header logo URL
 *
 * @param $url
 */

function wooadmin_namespace_login_headerurl( $url ) {
    $url = home_url( '/' );
    return $url;
}
add_filter( 'login_headertitle', 'wooadmin_namespace_login_headertitle' );

/**
 * Replaces the login header logo title
 *
 * @param $title
 */

function wooadmin_namespace_login_headertitle( $title ) {
    $title = get_bloginfo( 'name' );
    return $title;
}

// To change href link and title of admin theme login screen
// to change admin theme logo by the website logo

add_action( 'login_head', 'wooadmin_namespace_login_style1' );
function wooadmin_namespace_login_style1() {
    if( function_exists('get_custom_header') ){
        $width = get_custom_header()->width;
        $height = get_custom_header()->height;
    } else {
        $width = HEADER_IMAGE_WIDTH;
        $height = HEADER_IMAGE_HEIGHT;
    }
    echo '<style>'.PHP_EOL;
    echo '.login h1 a {'.PHP_EOL; 
    echo '  background-image: url( '; header_image(); echo ' ) !important; '.PHP_EOL;
    echo '  width: '.$width.'px !important;'.PHP_EOL;
    echo '  height: '.$height.'px !important;'.PHP_EOL;
    echo '  background-size: '.$width.'px '.$height.'px !important;'.PHP_EOL;
    echo '}'.PHP_EOL;
    echo '</style>'.PHP_EOL;
}
function wooadmin_namespace_login_style() {
    $url = plugins_url();
    echo '<style>.login #login h1 a {background-image: url('.$url.'/eshop_theme/img/eshopbox-logo.png)!important;
text-indent: -9999px;
outline: 0;
overflow: hidden;
padding-bottom: 0px;
display: block;
background-size: 187px 41px;}</style>';
}
// to change admin theme logo by the website logo
// To hide woocommerce meta tag in head

function wooadmin_remove_woo_commerce_generator_tag()
{
    remove_action('wp_head',array($GLOBALS['woocommerce'], 'generator'));
}
add_action('get_header','wooadmin_remove_woo_commerce_generator_tag');

// To hide woocommerce meta tag in head
// remove junk from head

function roots_head_cleanup() {
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  add_filter('use_default_gallery_style', '__return_null');
}
add_action('init', 'roots_head_cleanup');
?>
