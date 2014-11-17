<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/fabui/ajax/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/fabui/ajax/lib/utilities.php';

/** CREATE LOG FILES */
$_time                 = $_POST['time'];
$_destination_trace    = TEMP_PATH.'bed_calibration_'.$_time.'.trace';
$_destination_response = TEMP_PATH.'bed_calibration_'.$_time.'.json';

write_file($_destination_trace, '', 'w');
chmod($_destination_trace, 0777);

write_file($_destination_response, '', 'w');
chmod($_destination_response, 0777);

/** WAIT JUST 1 SECOND */
sleep(1);

/** EXEC COMMAND */
$h_over = 38;

$_command = 'sudo python '.PYTHON_PATH.'manual_bed_lev.py '.$_destination_response.' '.$_destination_trace.' '.$h_over.' ';  

$_output_command = shell_exec ( $_command );


/** WAIT JUST 1 SECOND */
sleep(1);

$_response = json_decode(file_get_contents($_destination_response), TRUE);



$screws = array();

$screws[0] = array('t' => $_response['bed_calibration']['t1'], 's'=>$_response['bed_calibration']['s1']);
$screws[1] = array('t' => $_response['bed_calibration']['t2'], 's'=>$_response['bed_calibration']['s2']);
$screws[2] = array('t' => $_response['bed_calibration']['t3'], 's'=>$_response['bed_calibration']['s3']);
$screws[3] = array('t' => $_response['bed_calibration']['t4'], 's'=>$_response['bed_calibration']['s4']);




?>


<table class="table table-hover screws-rows">
	
	<thead>
		<tr>
			<th class="text-center">Screw</th>
			<th class="text-center">Instructions</th>
		</tr>
	</thead>
		
	<tbody>
	<?php for($i=0; $i<4; $i++): ?>
		
		<tr class="<?php echo  get_row_color($screws[$i]['s'])?>">
			<td class="text-center"><span class="badge  badge <?php echo get_color($screws[$i]['s']); ?>"><?php echo ($i+1); ?></span></td>
			<td><?php echo get_rotation_number($screws[$i]['t']); ?>  - Direction:  <i class="fa <?php echo get_direction($screws[$i]['s']) ?> "></i> <?php echo round($screws[$i]['s'],3) ?></td>
		</tr>
	<?php endfor; ?>	
	</tbody> 
</table>

<?

function get_row_color($value){
	
	$value = abs(floatval($value));
	
	if($value > 0.2){
		return 'danger';
	}

	if(($value <= 0.2) && ($value > 0.1)){
		return 'warning';
	}
	
	if($value <= 0.1){
		return 'success';
	}	 
	
}




function get_color($value){
	
	$value = abs(floatval($value));
	
	if($value > 0.2){
		return 'bg-color-red';
	}

	if(($value <= 0.2) && ($value > 0.1)){
		return 'bg-color-orange';
	}
	
	if($value <= 0.1){
		return 'bg-color-green';
	}	 
}
// - senso orario
// + senso antioario



function get_direction($value){
	
	if($value > 0){
		return 'fa-rotate-right';
	}else{
		return 'fa-rotate-left';
	}
	
}


function get_rotation_number($value){
	
	
	$value = abs(floatval($value));
		
	if($value < 1){
		
		
		if($value == 0){
			return '<i class="fa fa-check"></a>';
		}
			
		return 'Turn for '.($value*360).' degrees';
		
	}else{
		$temp  = explode('.', $value);
		$number = $temp[0];
		
		
		$degree_val = '0.'.$temp[1];
		
		$degree = (floatval($degree_val * 360));
		
		$label_time = $number > 1 ? 'times' : 'time';
		
		return "Turn ".$number." ".$label_time." and ".$degree." degrees";
	}
	
}

?>