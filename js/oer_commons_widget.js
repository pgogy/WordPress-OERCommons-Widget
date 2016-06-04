function oer_commons_call(terms,max){
		
	jQuery(document).ready(function($) {
														
			var data = {
				action: 'oer_commons_search',
				no_items:max,
				keywords:terms
			};		
						
			jQuery.post(ajaxurl, data, 
							
			function(response){
				
				if(response.length!=0){
				
					document.getElementById('oer_commons_widget').innerHTML = "<p>Searching OER Commons for " + terms + "</p>" + response;
					
				}
								
			});
								
	});
			
}