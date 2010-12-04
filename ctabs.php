<?php
/*
Plugin Name: cTabs
Plugin URI: http://ctabs.webtmc.us
Description: Content Tabs (cTabs) allows you to post content into seperate tabs on a page using shortcodes. [shortcodes] . Usage instructions are located at our site. <a href="themes.php?page=ctabs-page">Options Panel</a> | <a href="http://ctabs.webtmc.us/forum">Support</a> | <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UC8RR2L9TUNVU">Donate</a>
Author: Brad Bodine
Version: 1.2
Author URI: http://truemediaconcepts.com

    Content Tabs is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt
*/

$ctabs_plugin_url = trailingslashit( get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );

/*
* Add jQuery - and alt js -----------------------------------------------------------
*/
		wp_enqueue_script("jquery"); 
		wp_enqueue_script('ctabs', $ctabs_plugin_url.'/ctabs.jquery.js', array('jquery'));
		wp_enqueue_script('ctabsInit', $ctabs_plugin_url.'/ctabs.init.js', array('ctabs'));

/*
* Add styles - only if shortcode is being used. Else don't call ----------------------
*/

add_filter('the_posts', 'ctabsTestPost');
function ctabsTestPost($posts){
	if ( empty($posts) ) return $posts;

	$ctabs_found = false;
	foreach ( $posts as $post ){
		if ( stripos($post->post_content, '[tabgroup]') ){
			$ctabs_found = true;
			break;
		}
	}

	if ( $ctabs_found ){
		wp_enqueue_style('ctabsReq', $ctabs_plugin_url.'/ctabs.req.css', array(), '1.0', 'screen');
		add_action ( 'wp_head', 'ctabs_addcss' );
	}

	return $posts;
}

/*
* Add Shortcodes ---------------------------------------------------------------------
*/

/* [tabgroup] tabs shortcodes and content go here. [/tabgroup] */
	add_shortcode( 'tabgroup', 'cTabGroup' ); 
	function cTabGroup( $atts, $content ){
		$GLOBALS['tab_count'] = 0;
		do_shortcode( $content );
		if( is_array( $GLOBALS['tabs'] ) ){
			$first = true;
			foreach( $GLOBALS['tabs'] as $tab ){
				$cHide = $first ? "" : "hide";
				$cCurrent = $first ? "current" : "";
				$cTabClass = strtr($tab['title'], " ", "_");
				$tabs[] = ''."\t \t".'<li class="'. $cTabClass .'"><a href="#'.$cTabClass.'" class="' . $cCurrent . '">'.$tab['title'].'</a></li>';
				$panes[] = ''."\t \t".'<div id="'.$cTabClass.'" class="' . $cHide . '">'."\n".''.do_shortcode($tab['content']).''."\n \t \t".'</div>';
				$first = false;
				
			}
			$return = "\n".'<!-- start Ctabs -->'."\n".'<div id="ctabs">'."\n \t".'<ul class="nav">'."\n".''.implode( "\n", $tabs ).''."\n \t".'</ul>'."\n".'<!-- tab "panes" -->'."\n \t".'<div class="list-wrap">'."\n".''.implode( "\n", $panes ).''."\n \t".'</div>'."\n".'</div>'."\n".'<!-- end Ctabs -->'."\n";
		}
		return $return;
	}
/* ------------------------------------------------------ */


/* [tab title="Tab 1"]   Tab 1 content goes here.   [/tab] */
	add_shortcode( 'tab', 'cTab' );
	function cTab( $atts, $content ){
		extract(shortcode_atts(array('title' => 'Tab %d'), $atts));
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
		$GLOBALS['tab_count']++;
	}
/* ------------------------------------------------------ */


/* Set default CSS -------------------------------------- */
$imgLocation = $ctabs_plugin_url;
$ctabs_default = '#ctabs { background: #eee; padding: 10px; margin: 14px; -moz-box-shadow: 0 0 5px #666; -webkit-box-shadow: 0 0 5px #666; box-shadow: 0 0 5px #666; border:1px solid #C2C2C2;}
#ctabs .nav { overflow: hidden; margin: 0 0 10px 0; }

#ctabs .nav li { float: left; margin:10px 5px 0 0;list-style: none !important; }

#ctabs .nav li a { display: block; padding:5px 10px; border:1px solid #ddd;text-align:center;text-decoration:none;font-weight:bold;background:url('.$imgLocation.'/images/fbsprite.gif) 0 0 repeat-x;font-family:Arial,Helvetica,sans-serif;font-size:0.825em;color:#000}


#ctabs .nav li a.current {border-color:blue; background-position:0 -48px; color:#fff;}
#ctabs .nav li a:hover { background-position:0 -96px; border-color:#028433; color:#fff;}

#ctabs ul.nav {border-bottom:1px solid #5872A7; padding-bottom:3px;}

';
/* ------------------------------------------------------ */


/* Define database options ------------------------------ */
$option_name = 'ctabs_css' ; 
$newvalue = $ctabs_default ;
  if ( get_option($option_name)  != true) {
    update_option($option_name, $newvalue);
  } else {
    $deprecated=' ';
    $autoload='no';
    add_option($option_name, $newvalue, $deprecated, $autoload);
  }
/* ------------------------------------------------------ */


/* CSS Options Filter ----------------------------------- */
function ctabs_css_filter($_content) {
	$_return = preg_replace ( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars ( strip_tags($_return), ENT_NOQUOTES, 'UTF-8' );
	return $_return;
}
/* ------------------------------------------------------ */


/* Main options and page compile ------------------------ */
function ctabs_options() {
	/*if user can't manage options the options page doesnt show*/
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $ctabs_default;
	$updated = false;
	$opt_name = 'ctabs_css';
	
	/*if there is nothing in the database, replace with default css*/
	$css_val = get_option ( $opt_name );
	if (empty ( $css_val )) {
		$css_val = $ctabs_default;
	}
	
	/*if reset is checked and option page is saved, reset the options database to default*/
	if ($_POST ['reset'] == 'true' && $_POST ['action'] == 'update') {
		$css_val = $ctabs_default;
		update_option ( $opt_name, $css_val );
		$reset = true;
	}

	/*if option page is saved and reset is not checked, update the options database*/
	if (!$_POST ['reset'] == 'true' && $_POST ['action'] == 'update') {
		$css_val = stripslashes ( $_POST [$opt_name] );
		update_option ( $opt_name, $css_val );
		$updated = true;
	}

	if ($updated) {
?>
	<div class="updated">
		<p><strong><?php _e ( 'Options saved.', 'mt_trans_domain' ); ?></strong></p>
	</div>
<?php }	

	if ($reset) {
?>
	<div class="updated">
		<p><strong><?php _e ( 'CSS set to default.', 'mt_trans_domain' ); ?></strong></p>
	</div>
<?php }	?>

<div class="wrap">
	<h2>Content Tabs (cTabs) Custom Styles CSS</h2>
	<form method="post" action="<?php echo $_SERVER ['REQUEST_URI']?>">
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Custom CSS<br /><em style="font-size:70%;">edit and save</em></th>
			<td><textarea style="width:100%" rows="15" name="<?php echo $opt_name?>"><?php echo $css_val?></textarea></td>
		</tr>
		<tr valign="top">
			<th scope="row">Usage Instructions</th>
			<td><p>cTabs uses shortcodes in the page content editor. Use the format below to create a group of content tabs on your page.</p>
<textarea style="width:100%" rows="10" name="instructions" readonly="yes" >
Keep the line above and below each shortcode empty. If you don't it will still work but wordpress may add a lot of space to the top of your tab groups.

[tabgroup]

[tab title="Tab One"]

	This is tab ones content.
	
[/tab]

[tab title="This is Tab Two"]

	This is the content in tab two.

[/tab]

[/tabgroup]

Thats it.
</textarea></td>
		</tr>		
	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="<?php echo $opt_name?>" />

	<p class="submit">
		<input type="submit" class="button-primary"	value="<?php _e ( 'Save Changes' )?>" />
		&nbsp;&nbsp;<em>Reset to Default CSS?</em>
		<input type="checkbox" name="reset" value="true" />
	</p>
</div>
<?php }
/* ------------------------------------------------------ */


/* Remove Database Option on Deactivate ----------------- */
function ctabs_remove_options() {
       delete_option('ctabs_css');
}
register_deactivation_hook(__FILE__, 'ctabs_remove_options');
/* ------------------------------------------------------ */


/* Add CSS to the head ---------------------------------- */
function ctabs_addcss() {
	$ctabs_css = get_option ( 'ctabs_css' );
	echo '<style type="text/css">' . "\n";
	echo ctabs_css_filter ( $ctabs_css ) . "\n";
	echo '</style>' . "\n";
}
/* ------------------------------------------------------ */


/* Add menu to admin page ------------------------------- */
function cTabs_menu() {
	add_theme_page('cTabs Options', 'cTabs', 'manage_options', 'ctabs-page', 'ctabs_options');
}
add_action('admin_menu', 'cTabs_menu');
/* ------------------------------------------------------ */





?>