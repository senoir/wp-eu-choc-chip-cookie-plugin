<?php

//flush the permalinks
add_action('admin_init', 'flush_rewrite_rules');
//start to build widget
class choc_chip_eu_cookie_widget extends WP_Widget
{
  function choc_chip_eu_cookie_widget()
  {
    $widget_ops = array('classname' => 'choc-chip-eu-cookie-widget', 'description' => 'Add opt-in code such as AdSense which will not be shown unless the user opts in' );
    $this->WP_Widget('choc-chip-eu-cookie-widget', 'Choc Chip EU Cookie Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'choc-chip-eu-cookie-widget-title' => '','choc-chip-eu-cookie-widget-code' => '' ) );
    $choc_chip_eu_cookie_widget_title = $instance['choc_chip_eu_cookie_widget_title'];
	 $choc_chip_eu_cookie_widget_code = $instance['choc_chip_eu_cookie_widget_code'];
?>
 <p><label for="<?php echo $this->get_field_id('choc_chip_eu_cookie_widget_title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('choc_chip_eu_cookie_widget_title'); ?>" name="<?php echo $this->get_field_name('choc_chip_eu_cookie_widget_title'); ?>" value="<?php echo attribute_escape($choc_chip_eu_cookie_widget_title); ?>" /></label></p>
 <p><label for="<?php echo $this->get_field_id('choc_chip_eu_cookie_widget_code'); ?>">Text: <textarea class="widefat" id="<?php echo $this->get_field_id('choc_chip_eu_cookie_widget_code'); ?>" name="<?php echo $this->get_field_name('choc_chip_eu_cookie_widget_code'); ?>" style="height:130px;"><?php echo attribute_escape($choc_chip_eu_cookie_widget_code); ?></textarea></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['choc_chip_eu_cookie_widget_title'] = $new_instance['choc_chip_eu_cookie_widget_title'];
	$instance['choc_chip_eu_cookie_widget_code'] = $new_instance['choc_chip_eu_cookie_widget_code'];
    return $instance;
  }

 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
   echo $before_widget;
    $choc_chip_eu_cookie_widget_title = empty($instance['choc_chip_eu_cookie_widget_title']) ? ' ' : apply_filters('widget_title', $instance['choc_chip_eu_cookie_widget_title']);
	$choc_chip_eu_cookie_widget_code = empty($instance['choc_chip_eu_cookie_widget_code']) ? ' ' : apply_filters('widget_code', $instance['choc_chip_eu_cookie_widget_code']);
	
 	 // start widget code
	 
	 //create unique name by using the url
	$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);
	
	
	if(isset($_COOKIE["$choc_chip_cookie_name"])) { 	
    	if (!empty($choc_chip_eu_cookie_widget_title))
     		 echo $before_title . $choc_chip_eu_cookie_widget_title . $after_title;
	  	if (!empty($choc_chip_eu_cookie_widget_code))
      		echo  $choc_chip_eu_cookie_widget_code ;
	}
   
   	//end widget code
 echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("choc_chip_eu_cookie_widget");') );
?>