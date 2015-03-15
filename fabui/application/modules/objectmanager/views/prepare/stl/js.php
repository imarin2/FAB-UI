<script type="text/javascript">


    var monitor_uri = '';
    var interval_monitor;
    
    var trace_uri = '';
    var interval_trace;
    
    var interval_timer;
    var elapsed_time   = 0;
    var time_left      = 0;
    var estimated_time = 0;
    
    var mesh_finished = false;
    
    var time_left_saved = 0;
    
    var output_file_id;
    var task_id = <?php echo $_task ? $_task['id'] : '""' ?>;
    
    
    
    
    $(function () {
    	$("#stop-process").on('click', ask_stop);
    });
    
    
    
    <?php if($_task): ?>
    
    	resume();
    	
    	function resume(){
    		
    		<?php $_task_attributes = json_decode($_task['attributes'], true) ; ?>
    		
    		<?php $_json_monitor = json_decode(file_get_contents($_task_attributes['monitor']), true); ?>
    		
    		
    		monitor_uri = '<?php echo str_replace('/var/www', '',  $_task_attributes['monitor']); ?>';
    		trace_uri = '<?php echo str_replace('/var/www', '',  $_task_attributes['trace']); ?>';
    		
    		var now = new Date().getTime();
    		now = (now / 1000);
    		
    		var started = <?php echo str_replace('', '', $_json_monitor['Meshing']['started']) ?>;
    		elapsed_time = (now - started);
    		
    		interval_monitor   = setInterval(monitor, 1000);
            interval_trace     = setInterval(trace, 3000);
            interval_timer     = setInterval(timer, 1000);
            
            $("#stop-process").show();
            
            
            
    		
    		
    		
    	}
    
    <?php endif; ?>


    $('#procees-button').on('click', function(){
        
        $.SmartMessageBox({
    				title: "<i class='fa fa-warning txt-color-orange'></i> This operation would take few minutes",
    				content: "<br>Continue?",
    				buttons: '[No][Yes]'
    			}, function(ButtonPressed) {
    				if (ButtonPressed === "Yes") {
                        
                        process();
    					
    				}
        });
        
    });
    
    
    
    
    function process(){
            
            $("#procees-button").find("i").addClass('fa-spin');
            $("#procees-button").addClass('disabled');
            $("#procees-button").html($("#procees-button").html().replace('Process', 'Processing'));
            
            
            var file = '<?php echo $_file->full_path; ?>';
            
        	$.ajax({
    			type: "POST",
    			url: "<?php echo module_url('objectmanager').'ajax/process.php' ?>/",
                data: {type: 'stl', file: file,  output: $("#output").val(), object : <?php echo $_object; ?>, id_file : <?php  echo $_file->id;?> },
                dataType: 'json'
    		}).done(function(response) {
    		       
                    $("#procees-button").removeClass('disabled');
                    $("#procees-button").html($("#procees-button").html().replace('Processing', 'Process'));
                    $("#procees-button").find("i").removeClass('fa-spin');
                    
                     $( ".setting" ).slideUp( "slow", function() {
                   
                        $( ".monitor" ).slideDown( "slow", function() {});
                   
                   
                    });
                    
                    
                    
                    
                    
                    var monitor_json = JSON.parse(response.monitor_json);
                    monitor_json     = jQuery.parseJSON(monitor_json);
                   
                   	
                    trace_uri   = response.trace_uri;
                    monitor_uri = response.monitor_uri;
                    task_id     = response.task_id;
                    time_left   = parseInt(monitor_json.Meshing.stats.time_left);
                   
                    output_file_id = parseInt(response.id_new_file);
                   
                    interval_monitor   = setInterval(monitor, 1000);
                    interval_trace     = setInterval(trace, 3000);
                    interval_timer     = setInterval(timer, 1000);
                    
                    $("#stop-process").show();
                    
                    
                   
    		});
        
        
    }
    
    
    
    function monitor(){
        
        
        if(!SOCKET_CONNECTED){
        
	        if(mesh_finished == false){
	            monitor_get();
	        }else{
	            
	            clearInterval(interval_monitor);
	            clearInterval(interval_trace);
	            clearInterval(interval_timer);
	               
	            $( ".monitor" ).slideUp( "slow", function() {
	                 $( ".complete" ).slideDown( "slow", function() {});
	            });   
	        }
        }
        
    }
    
    
    
    
    function monitor_get(){
        
        
        $.get( monitor_uri , function( data ) {
        
            if(data != ''){               
                monitor = data;
            	manage_update(monitor);
 
            }
            
        }).fail(function(){ 
                
        });
        
    }
    
    
    
    function trace(){
        if(!SOCKET_CONNECTED){
	        $.get( trace_uri , function( data ) {
	            
	            if(data != ''){
	                
	                var trace = data;
	                
	                trace = trace.replace('\n', '<br>');
	                trace = trace.replace('<?php echo PHP_EOL; ?>', '<br>');   
	                $(".console").html(trace);
	            }
	        }).fail(function(){ 
	                
	        });
        }
    }
    
    
    
    function timer() {
    
    	/**
    	 * ELAPSED TIME
    	 */
    	elapsed_time = (parseInt(elapsed_time) + 1);
    	$('.elapsed-time').html(_time_to_string(elapsed_time));
    
    	/**
    	 * TIME LEFT
    	 */
        time_left = (parseInt(time_left) - 1 );
        if(time_left >= 0){
            $('.estimated-time-left').html(_time_to_string(time_left));
        }
    
    }
    
    
    function ask_stop(){
    	
    	
    	$.SmartMessageBox({
    		title: "<i class='fa fa-warning txt-color-orange'></i> Do you really want to stop the process?",
    		buttons: '[No][Yes]'
    	}, function(ButtonPressed) {
			if (ButtonPressed === "Yes") {    
	            stop_process();
			}
        });
    	
    	
    }
    
    function stop_process(){
    	
    	
    	openWait('Stopping process, please wait..');
    	
    	clearInterval(interval_monitor);
        clearInterval(interval_trace);
        clearInterval(interval_timer);
    	
    	
    	$.ajax({
    			type: "POST",
    			url: "<?php echo module_url('objectmanager').'ajax/stop_process.php' ?>/",
                data: {task_id: task_id},
                dataType: 'json'
    		}).done(function(response) {
    		    	waitTitle("Reload page");    
                   	document.location.href=document.location.href;
    		});
    	
    }
    
    function manage_task_monitor(obj){
    			
		if(obj.content != ""){
			var monitor = jQuery.parseJSON(obj.content);
			manage_update(monitor);
				
		}
	}
	
	function manage_update(obj){
		
		$('#lines-progress').attr('style', 'width:' + parseInt(obj.Meshing.stats.percent) + '%');
        $('#lines-progress').attr('aria-valuetransitiongoal',  parseInt(obj.Meshing.stats.percent));
        $('#lines-progress').attr('aria-valuenow', parseInt(obj.Meshing.stats.percent));
                
        $('#lines-progress').html(number_format(parseInt(obj.Meshing.stats.percent), 1, ',', '.') + ' %');
		$('.progress-status').html(	number_format(parseInt(obj.Meshing.stats.percent),1, ',', '.') + ' %');
        $('#label-progress').html('(' +	number_format(parseInt(obj.Meshing.stats.percent), 1, ',', '.') + ' % )');
        
        if(time_left_saved != parseInt(obj.Meshing.stats.time_left)){
            time_left       = parseInt(obj.Meshing.stats.time_left);
            time_left_saved = time_left;
        }
        
        
        $('.estimated-time').html(_time_to_string(parseInt(obj.Meshing.stats.time_total)));
        
        mesh_finished = parseInt(obj.Meshing.completed) == 1 ? true : false;
        
        if(mesh_finished){
        	$( ".monitor" ).slideUp( "slow", function() {
	        	$( ".complete" ).slideDown( "slow", function() {});
	        }); 
        }
}
    
    
    



</script>