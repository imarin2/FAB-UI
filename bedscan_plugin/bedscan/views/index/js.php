<script type="text/javascript">
	
	var ticker_url = '';
	var interval_ticker;

	$(function () {
		
		$(".do-bedscan").on('click', do_bedscan);
		interval_ticker   = setInterval(ticker, 500);
		
		
	});
	
	
	
	function ticker(){
		
	    if(ticker_url != ''){
	        
	         $.get( ticker_url , function( data ) {
	           
	            if(data != ''){
	            	
	            	waitContent(data);
	              
	            }
	       }).fail(function(){ 
	           
	        });
	    }
	}
	
	
	
	
	function do_bedscan(){
		
		openWait('Bed scan in process');
		
		var now = jQuery.now();
		ticker_url = '/temp/bed_scan_' + now + '.trace'; 
		
		
		
		$.ajax({
			type: "POST",
			url : "../application/plugins/bedscan/ajax/bed_scan.php",
			data : {time: now},
			dataType: "html"
		}).done(function( data ) {
			
			
			closeWait();
			ticker_url = '';
			
			if($(".step-1").is(":visible") ){
				
				$(".step-1").slideUp('fast', function(){
					
					$(".step-2").slideDown('fast');
					
				});
				
			}
			
			$(".todo").html(data);
			
			
			
		});
		
		
		
	}	

	
</script>
