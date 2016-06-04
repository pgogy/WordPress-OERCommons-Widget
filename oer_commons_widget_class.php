<?php 

/**
 * RSS widget class
 *
 * @since 2.8.0
 */
class oer_commons_widget extends WP_Widget_RSS {
	
	function oer_commons_widget() {
	
		$widget_ops = array( 'description' => __('Displays OER Commons Content') );
		$this->WP_Widget( 'oer_commons_widget', __('OER Commons search and display'), $widget_ops);
		
	}

	function widget($args, $instance) {
	
		global $post;

		if ( isset($instance['error']) && $instance['error'] )
			return;
						
		if(!is_home()){
		
			$words = array();
		
			$post_categories = wp_get_post_categories($post->ID);
			
			foreach($post_categories as $data => $value){
			
				$data = get_category($value);
				array_push($words,$data->name);
			
			}
		
		}else{		
		
			$words = array();
		
			$post_categories = get_categories();
			
			foreach($post_categories as $data => $value){
			
				array_push($words,$value->name);
			
			}
						
		}
		?>
			<script type="text/javascript" language="javascript">
				oer_commons_call('<?PHP echo $words[0]; ?>','<?PHP echo $instance["number_links"]; ?>');	
			</script>				
			<ul id='oer_commons_widget'></ul>
		<?PHP
				
	}

	function form($instance) {	

		if(!isset($instance["number_links"])){
			$instance["number_links"] = 10;
		}
		
		echo '<p><label for="' . $this->get_field_id("number_links") .'">Number of links to display (maximum):</label>';
		echo '<input type="text" name="' . $this->get_field_name("number_links") . '" '; 
		echo 'id="' . $this->get_field_id("number_links") . '" value="' . $instance["number_links"] . '" /></p>';

	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;		
		$instance['number_links'] = $new_instance['number_links'];	
		return $instance;
	}
	
}

 ?>