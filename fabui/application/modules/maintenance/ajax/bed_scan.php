<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/fabui/ajax/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/fabui/ajax/lib/utilities.php';

/** CREATE LOG FILES */
$_time                 = $_POST['time'];
$_destination_trace    = TEMP_PATH . 'bed_scan_' . $_time . '.trace';
$_destination_response = TEMP_PATH . 'bed_scan_' . $_time . '.png';

write_file($_destination_trace, '', 'w');
chmod($_destination_trace, 0777);

/** WAIT JUST 1 SECOND */
sleep(1);

/** EXEC COMMAND */
$_command = 'sudo python ' . PYTHON_PATH . 'scan_bed.py ' . $_destination_response . ' ' . $_destination_trace ;

$_output_command = shell_exec($_command);

/** WAIT JUST 1 SECOND */
sleep(1);

$_response = file_exists($_destination_response);
?>


<?php if($response == TRUE): ?>
	
	<div class="alert alert-success alert-block">
		<h4 class="alert-heading"><i class="fa fa-check"></i> Scan finalised!</h4>
	</div>
	
	<div class="col-sm-6 text-center">
		<img style="max-width: 50%; display: inline;" class="img-responsive" src="<?php echo($_destination_response) ?>" />
	</div> 

<?php else: ?>

	<div class="alert alert-danger alert-block">
		<h4 class="alert-heading"><i class="fa fa-check"></i> Scan failed!</h4>
	</div>
	
<?php endif; ?>
