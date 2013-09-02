<?php
$choc_chip_eu_cookie_appearance = array(
	'barbg' => '',
	'barposition' => '',
	'textcolor' => '',
	'acceptlinkcolor' => '',
	'acceptbuttonbgcolor' => '',
	'acceptbuttonbordercolor' => '',
	'morebuttonlinkcolor' => '',
	'morebuttonbgcolor' => '',
	'morebuttonbordercolor' => '',
);

$choc_chip_eu_cookie_optin = array(
	'optin1' => '',
	'infolink' => '#',
	'buttonbartext' => '',
	'commentformtext' => '',
);



function choc_chip_eu_cookie_appearance_settings() {
	// Register settings and call sanitation functions
	register_setting( 'choc_chip_eu_cookie_appearance_theme', 'choc_chip_eu_cookie_appearance', 'choc_chip_eu_cookie_validate_appearance' );
	register_setting( 'choc_chip_eu_cookie_optin_theme', 'choc_chip_eu_cookie_optin', 'choc_chip_eu_cookie_validate_optin' );
}
add_action( 'admin_init', 'choc_chip_eu_cookie_appearance_settings' );

// Function to generate options page
function choc_chip_eu_cookie_appearance_options() {
	global $choc_chip_eu_cookie_appearance;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap" style="padding:30px">

	<?php screen_icon(); echo "<h2>Appearance</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'choc_chip_eu_cookie_appearance', $choc_chip_eu_cookie_appearance ); ?>
	
	<?php settings_fields( 'choc_chip_eu_cookie_appearance_theme' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	<style>label { font-weight:bold;}</style>
	<tr valign="top">
    	<th width="30%" scope="row" ><label for="barposition">Bar position</label>
        <p>Select the position for the button bar</p>
        </th>
			<td width="70%" valign="bottom">  
            	<?php  $position = esc_attr($settings['barposition']); ?> 
				<select id="barbg" name="choc_chip_eu_cookie_appearance[barposition]" >
                <option value="bottom" <?php if ($position == "bottom") { echo 'selected=selected';}?>>Bottom</option>
                <option value="top" <?php if ($position == "top") { echo 'selected=selected';}?>>Top</option>
                </select>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="barbg">Background colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p>
        </th>
			<td width="70%" valign="bottom">   
				<input id="barbg" name="choc_chip_eu_cookie_appearance[barbg]" type="text" value="<?php  esc_attr_e($settings['barbg']); ?>" />
			</td>
		</tr>

		<tr valign="top"><th scope="row"><label for="textcolor">Text Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="textcolor" name="choc_chip_eu_cookie_appearance[textcolor]" type="text" value="<?php  esc_attr_e($settings['textcolor']); ?>" />
			</td>
		</tr>

	<tr valign="top"><th scope="row"><label for="acceptlinkcolor">Accept Button Text Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="acceptlinkcolor" name="choc_chip_eu_cookie_appearance[acceptlinkcolor]" type="text" value="<?php  esc_attr_e($settings['acceptlinkcolor']); ?>" />
			</td>
		</tr>
        
      
      <tr valign="top"><th scope="row"><label for="acceptbuttonbgcolor">Accept Button Background Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="acceptbuttonbgcolor" name="choc_chip_eu_cookie_appearance[acceptbuttonbgcolor]" type="text" value="<?php  esc_attr_e($settings['acceptbuttonbgcolor']); ?>" />
			</td>
		</tr>

      <tr valign="top"><th scope="row"><label for="acceptbuttonbordercolor">Accept Button Border Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="acceptbuttonbordercolor" name="choc_chip_eu_cookie_appearance[acceptbuttonbordercolor]" type="text" value="<?php  esc_attr_e($settings['acceptbuttonbordercolor']); ?>" />
			</td>
		</tr>
        
        <tr valign="top"><th scope="row"><label for="morebuttonlinkcolor">More info Button Text Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="morebuttonlinkcolor" name="choc_chip_eu_cookie_appearance[morebuttonlinkcolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonlinkcolor']); ?>" />
			</td>
		</tr>

      <tr valign="top"><th scope="row"><label for="morebuttonbordercolor">More info Button Border Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="morebuttonbordercolor" name="choc_chip_eu_cookie_appearance[morebuttonbordercolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonbordercolor']); ?>" />
			</td>
		</tr>


      <tr valign="top"><th scope="row"><label for="morebuttonbgcolor">More info Button Background Colour</label>
        <p>Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000</p></th>
			<td valign="bottom">
				<input id="morebuttonbgcolor" name="choc_chip_eu_cookie_appearance[morebuttonbgcolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonbgcolor']); ?>" />
			</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}// ends appearance page



// Function to generate Opt in page
function choc_chip_eu_cookie_optin_options() {
	global $choc_chip_eu_cookie_optin;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap" style="padding:30px">

	<?php screen_icon(); echo "<h2>Options</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'choc_chip_eu_cookie_optin', $choc_chip_eu_cookie_optin ); ?>
	
	<?php settings_fields( 'choc_chip_eu_cookie_optin_theme' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table">
	<style>label { font-weight:bold;}</style>
    <tr valign="top">
    	<th width="30%" scope="row" ><label for="buttonbartext">Button Bar Text</label>
        <p>Enter the text that you would like to see in the button bar.</p>
        </th>
			<td width="70%" valign="middle"> 
            
            	<input id="buttonbartext" name="choc_chip_eu_cookie_optin[buttonbartext]" type="text" value="<?php esc_attr_e($settings['buttonbartext']) ?>" max="80" style="width:70%"/>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="infolink">Cookie Information Page</label>
        <p>Select the page where your cookie information can be found.</p>
        </th>
			<td width="70%" valign="middle"> 
            	<?php $setlink = esc_attr($settings['infolink']) ?>
            	<select id="infolink" name="choc_chip_eu_cookie_optin[infolink]">
            	<?php 
					$pages=  get_pages(''); 
					foreach ($pages as $page) {					
						$selected = "";
						if ($setlink == $page->post_name) { $selected = 'selected="selected"';}
						$option = '<option value="' . $page->post_name .  '" ' . $selected . '>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
					?>
                </select>
			
			</td>
		</tr>
        
	<tr valign="top">
    	<th width="30%" scope="row" ><label for="optin1">Opt-in - Header Code</label>
        <p>If you have custom code in the  &lt;head&gt; of your website such as Google analytics, you can make it opt-in by pasting the code in this box. The code will not be shown unless the visitor has clicked the 'Accept' button.</p>
        </th>
			<td width="70%" valign="bottom">   
				<textarea id="optin1" name="choc_chip_eu_cookie_optin[optin1]" style="width:70%; min-height:300px"><?php  esc_attr_e($settings['optin1']); ?></textarea>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="commentformtext">Comment form cookie warning</label>
        <p>Warn your visitors that by placing a comment on your website they are agreeing to have a cookie placed on their computer. This text will appear on the comment form.</p>
        </th>
			<td width="70%" valign="bottom">   
				<textarea id="commentformtext" name="choc_chip_eu_cookie_optin[commentformtext]" style="width:70%; min-height:300px"><?php  esc_attr_e($settings['commentformtext']); ?></textarea>
			</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

// Function to generate about page
function choc_chip_eu_cookie_general() { ?>

	<div class="wrap" style="padding:30px">

	<?php screen_icon(); echo "<h2>Choc Chip EU Cookie Plugin</h2>";
	// This shows the page's name and an icon if one has been provided ?>
	<p>Written by <a href="http://www.christiansenior.co.uk">Christian Senior</a> of <a href="http://www.obimedia.co.uk">Obi Media</a> with the help of the internet, late nights and caffeine</p>
    
    <h2>What's it all about?</h2>
    <p>The EU cookie directive may not be the most welcome law but, as Voltaire said 'in order to be free we must all be slaves to the law'. I'm not sure how true that is either, but in any case it has caused me to sit down and write this Wordpress plugin to make abiding by the rules that bit easier.</p>
    
    <h2>What does this Choc Chip thing do?</h2>
    <p>It gives your visitors the option to opt in to any third party applications such as Google Analytics or Ad Sense. The Choc Chip Cookie Plugin then leaves a cookie of its own to remember them next time. The cookie willl expire after one year. There are a few options with this little badger to help you comply with the EU cookie directive and also pimp it up to suit your website.</p>
    
    <h2>Choc Chip Cookie EU Cookie Plugin Widget</h2>
    <p>This plugin comes with an opt-in widget for your sidebar. Anything added to the Choc Chip EU Cookie Plugin widget is opt in. So if you insert your Adsense code here it will only show if the visitor has accepted cookies. Cool uh?! </p>
    
    <h2><a href="options-general.php?page=choc_chip_eu_cookie&tab=optin">Options</a></h2>
    
    <h3>Button Bar Text</h3>
    <p>Edit the warning text as shown on the button bar. Try something like 'Hey you, you are browsing my website so you are having cookies'. OK maybe not qute that but something similar.</p>
    
    <h3>Cookie Information Page</h3>
    <p>Create a page that contains your cookie information such as what cookies are and what you use them for. Select your cookie information page from the list and this will link to the 'More info' button on the button bar.</p>
    
    <h3>Opt in header code</h3>
    <p>Third party applications such as Google Analytics leave a cookie in order to be able to track your visitors. The EU Cookie Directive wants you to warn people of this and even have them 'opt in' so you shouldnt track them unless they agree to it. Any text/code that you enter in the 'opt in header code' field will only be activated once the 'allow' button has been clicked. Any text/code in this field will be placed just above the <code> &lt;/head&gt; </code> tag.</p>
    
    <h3>Comment Form Warning</h3>
    <p>Wordpress leaves a cookie when a comment is left (to save the form information so it doesnt have to be filled in next time) so give your visitors a warning and let them whats going down. Try something like 'By leaving a comment you are agreeing to have a new friend in the same shape as a cookie popped onto your hard drive'.</p>
    
     <h2><a href="options-general.php?page=choc_chip_eu_cookie&tab=appearance">Appearance</a></h2>
     
    <h3>Bar Position</h3>
    <p>Select the position for your button bar</p>
    
    <h3>Background Colour</h3>
    <p>Change the background of your button bar by entering the name of the colour or if youre a smarty pants you can enter a hex value.</p>
    
    <h3>Text Colour</h3>
    <p>Change the main text colour on the button bar by entering the name of the colour, now try to be sensible as 'off white' aint gonna cut the mustard sonny Jim.</p>
    
    <h3>Accept Button Text Colour</h3>
    <p>Have a guess what this does? Thats right it changes the accept button text colour. Pop your favourite colour in the box.</p>
    
    <h3>Accept Button Background Colour</h3>
    <p>Make that button stand out with a smashing background colour.</p>
    
    <h3>Accept Button Border Colour</h3>
    <p>Thats right you can even change the colour of the border of the button. Your visitors will be sad to see it disappear when they click the button.</p>
    
    <h3>More Info Button Text Colour</h3>
    <p>We've moved on to the next button so make this one just as important as the last one as it points to important information</p>
    
    <h3>More Info Button Background Colour</h3>
    <p>Make it shine man, make it shine</p>
    
    <h3>More Info Button Border Colour</h3>
    <p>Come on this is the last colour change so make it count</p>
    
    <p>Now dont forget to press save after you make any changes.</p>
    
    <h2>Disclaimer</h2>
    <p>I am not a lawyer nor am I, nor have I ever been a policeman so my knowledge of the law is pretty limited. And to top it all off I once got into trouble for stealing sweets from my local shop, my mum was not happy and I got grounded for quite some time. But I've grown both mentally and physically since then. Anyway I digress, if you get into trouble for not abiding by the EU cookie law even after using this plugin, I accept no responsibility. You are welcome to use this plugin but it comes with no guarantees as to its compliance of the law. If you are in any doubt you should seek real legal advice.</p>
    
	</div>
<?php } //ends about us function

function choc_chip_eu_cookie_validate_appearance( $input ) {
	global $choc_chip_eu_cookie_appearance;

	$settings = get_option( 'choc_chip_eu_cookie_appearance', $choc_chip_eu_cookie_appearance );
	
	return $input;
}

function choc_chip_eu_cookie_validate_optin( $input ) {
	global $choc_chip_eu_cookie_optin;

	$settings = get_option( 'choc_chip_eu_cookie_optin', $choc_chip_eu_cookie_optin );
	
	return $input;
}
?>