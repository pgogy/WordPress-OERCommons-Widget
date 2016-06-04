<?PHP
		
	/**
	 * Add actions for both logged in and not logged in users
	 */
	add_action('wp_ajax_nopriv_oer_commons_search', 'oer_commons_get');
	add_action('wp_ajax_oer_commons_search', 'oer_commons_get');
	
	function oer_commons_get(){
	
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://www.oercommons.org/search?f.search="  . str_replace(" ","+",$_POST['keywords']) . "&feed=yes");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_MAXREDIRS,10);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,100);
		curl_setopt($ch,CURLOPT_USERAGENT,"OER Commons WordPress Widget");
		curl_setopt($ch,CURLOPT_HTTP_VERSION,'CURLOPT_HTTP_VERSION_1_1');
		$data = curl_exec($ch);		

		$xml = @simplexml_load_string($data);
		
		$counter =0;
		
		if($xml){	
						
			foreach($xml as $data => $value){
					
				if($data=="item"){
								
					if($counter!=$_POST['no_items']){
				
						echo "<li>";					
						echo "<p><a href='" . $value->link . "'>" . $value->title . "</a> | <a class='oer-commons-widget-link' title='click to expand' onclick='javascript:if(document.getElementById(\"oer_commons_widget_" . $counter. "\").style.display==\"block\"){document.getElementById(\"oer_commons_widget_" . $counter. "\").style.display=\"none\"}else{document.getElementById(\"oer_commons_widget_" . $counter. "\").style.display=\"block\"};'>+</a>";
						echo "<span id='oer_commons_widget_" . $counter++ . "'>" . $value->Description . "</span></p></li>";
					
					}

				}	
			
			}
		
		}
		
		die(); // this is required to return a proper result
		
	}
	
?>