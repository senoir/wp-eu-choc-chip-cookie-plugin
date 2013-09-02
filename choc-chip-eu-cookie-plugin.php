<?php
/*
Plugin Name: Choc Chip EU Cookie Plugin
Plugin URI: http://www.christiansenior.co.uk/talkin-shop/choc-chip-eu-cookie-wordpress-plugin
Description: Opt in cookie plugin
Author: Christian Senior
Version: 1
Author URI: http://www.christiansenior.co.uk
*/


	
	
//include admin options
			require_once 'inc/choc-chip-cookie-plugin-options.php';
			
			//load jquery from Google
			function choc_chip_eu_cookie_jquery() {
						if (!is_admin()) {
							wp_deregister_script('jquery');
							wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2');
							wp_enqueue_script('jquery');
						}
					}
			add_action('init', 'choc_chip_eu_cookie_jquery');
			
			//add the stylesheet to the site
			function choc_chip_eu_cookie_stylesheet() {
					echo '<link rel="stylesheet" type="text/css" media="all" href="'. plugins_url( 'css/choc-chip-eu-cookie-plugin.css' , __FILE__ ) . '" />'; ?>
					
					<!--custom styling set through the admin panel-->
					<?php $choc_chip_eu_cookie_appearance_settings = get_option( 'choc_chip_eu_cookie_appearance', $choc_chip_eu_cookie_appearance ); ?>
					<style>
					#cookie-allow {
						  background-color:<?php echo $choc_chip_eu_cookie_appearance_settings['barbg']; ?>;
						  color:<?php echo $choc_chip_eu_cookie_appearance_settings['textcolor']; ?>;
						  <?php if ($choc_chip_eu_cookie_appearance_settings['barposition'] == "top") { 
									echo 'top' ;
									} else if ($choc_chip_eu_cookie_appearance_settings['barposition'] == "bottom") {  
									echo 'bottom';
									} else {
									echo 'bottom';
									}?>:0;
					}
					#cookie-allow a.allow {
						  color:<?php echo $choc_chip_eu_cookie_appearance_settings['acceptlinkcolor']; ?>;
					 }
					#cookie-allow a.allow {
						   background-color:<?php echo $choc_chip_eu_cookie_appearance_settings['acceptbuttonbgcolor']; ?>;
						   border:solid 1px <?php echo $choc_chip_eu_cookie_appearance_settings['acceptbuttonbordercolor']; ?>;
					   }
					   #cookie-allow a.cookiemore {
						   background-color:<?php echo $choc_chip_eu_cookie_appearance_settings['morebuttonbgcolor']; ?>;
						   border:solid 1px <?php echo $choc_chip_eu_cookie_appearance_settings['morebuttonbordercolor']; ?>;
						   
					   }
						#cookie-allow a.cookiemore {
						  color:<?php echo $choc_chip_eu_cookie_appearance_settings['morebuttonlinkcolor']; ?>;
					 }
					</style>
					
					<?php }// add stylesheet function 
			add_action('wp_head', 'choc_chip_eu_cookie_stylesheet');
			
			
					
			//if they have not allowed cookies before show the accept button
			function choc_chip_eu_cookie_setcookie() { 
				
				//create unique name by using the url
				$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
				$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);
			
				if(!isset($_COOKIE["$choc_chip_cookie_name"])) { 	
				
					 $choc_chip_eu_cookie_optin = get_option( 'choc_chip_eu_cookie_optin', $choc_chip_eu_cookie_optin );	
			?>
				  
				<script type="text/javascript">
					function SetCookie(c_name,value,expiredays)
					{
					var exdate=new Date()
						exdate.setDate(exdate.getDate()+expiredays)
						document.cookie=c_name+ "=" +escape(value)+";path=/"+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
					}
				</script>
				<link rel="stylesheet" type="text/css" media="all" href="<?php plugins_url();?>/css/" />
					<div id="cookie-allow" >
						<?php if ($choc_chip_eu_cookie_optin['buttonbartext'] == "") { echo 'We use cookies. By browsing this site you agree to the use of cookies'; } else { echo $choc_chip_eu_cookie_optin['buttonbartext'];} ?>
						<a id="removecookie" class="allow">ACCEPT</a>
						<a id="more" class="cookiemore" href="<?php bloginfo('url');?>/<?php echo $choc_chip_eu_cookie_optin['infolink']; ?>" target="_blank">Find out more</a>
					</div>
				
				 
				<script type="text/javascript">
					if( document.cookie.indexOf("<?php echo $choc_chip_cookie_name;?>") ===-1 ){
						jQuery("#cookie-allow").show();
					}
					jQuery("#removecookie").click(function () {
						//Expiration of cookie. 365 is days 1 is year
						SetCookie('<?php echo $choc_chip_cookie_name;?>','<?php echo $choc_chip_cookie_name;?>',365*1)
					  jQuery("#cookie-allow").remove();
					  
					  //refresh page to show opt in options immediately
					  location.reload();
					});
				</script>
				<?php } //if cookie is not set ?>
			<?php }//setcookie function
			add_action('wp_footer', 'choc_chip_eu_cookie_setcookie');
			
			
			
			//tabbed admin section
			function choc_chip_eu_cookie_admin_menu() {
				add_options_page('Choc Chip EU Cookie Options', 'Choc Chip EU Cookie', 'manage_options', 'choc_chip_eu_cookie', 'choc_chip_eu_cookie_options');
			}
			add_action('admin_menu', 'choc_chip_eu_cookie_admin_menu');
			
			//create tabs for admin section
			function choc_chip_eu_cookie_admin_tabs( $current = 'general' ) {     
				$tabs = array( 'general' => 'About', 'optin' => 'Options', 'appearance' => 'Appearance' );     
				$links = array();     
				foreach( $tabs as $tab => $name ) :         
				if ( $tab == $current ) :             
				$links[] = "<a class='nav-tab' href='?page=choc_chip_eu_cookie&tab=$tab'>$name</a>";         
				else :             
				$links[] = "<a class='nav-tab' href='?page=choc_chip_eu_cookie&tab=$tab'>$name</a>";         
				endif;     
				endforeach;    
				echo '<h2>';     
				foreach ( $links as $link )         
				echo $link;     echo '</h2>';
			}
			
			 function choc_chip_eu_cookie_options() {
				if (!current_user_can('manage_options'))  {
					wp_die( __('You do not have sufficient permissions to access this page.') );
				}
			?>
				
			<div class="wrap">
			<?php choc_chip_eu_cookie_admin_tabs();?>    
			 <?php //sets up the info to be displayed in the tab
				  
				if ( isset ( $_GET['tab'] ) ) {         
				$tab = $_GET['tab'];        
				switch ( $tab ) :         
				case 'appearance' :             
				choc_chip_eu_cookie_appearance_options();  
				break;         
				case 'optin' :             
				choc_chip_eu_cookie_optin_options();  
				break;         
				case 'general' :            
				choc_chip_eu_cookie_general();             
				break;     
				endswitch; 
				} else {
					$tab = 'general';
					choc_chip_eu_cookie_general();     
				}//if get tab is set
				?>    
				
			
					
				</div><!--wrap-->
			   
			<?php } //end options if
			 
			//function to allow opt in options if accept has been clicked
			function choc_chip_eu_cookie_show_optin_options() {
				//create unique name by using the url
				$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
				$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);
				
				if(isset($_COOKIE["$choc_chip_cookie_name"])) { 	
					$choc_chip_eu_cookie_optin = get_option( 'choc_chip_eu_cookie_optin', $choc_chip_eu_cookie_optin );
					echo $choc_chip_eu_cookie_optin['optin1'];
				}
			}
			
			add_action('wp_head', 'choc_chip_eu_cookie_show_optin_options');
			
			//include widget
			require_once 'inc/choc-chip-cookie-plugin-widget.php';
			
			
			//hook into the comment form text
			add_action( 'comment_form_logged_in_after', 'pmg_comment_tut_fields' );
			add_action( 'comment_form_after_fields', 'pmg_comment_tut_fields' );
			function pmg_comment_tut_fields()
			{
				$choc_chip_eu_cookie_optin = get_option( 'choc_chip_eu_cookie_optin', $choc_chip_eu_cookie_optin );
				?>
					<p>
						<?php echo $choc_chip_eu_cookie_optin['commentformtext']; ?>
					</p>
				<?php
			}

?>