<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/utilities.php';

/** CREATE LOG FILES */
$_time                 = $_POST['time'];
$_destination_trace    = TEMP_PATH.'macro_trace';
$_destination_response = TEMP_PATH.'macro_response';

write_file($_destination_trace, '', 'w');
chmod($_destination_trace, 0777);

write_file($_destination_response, '', 'w');
chmod($_destination_response, 0777);

/** WAIT JUST 1 SECOND */
sleep(1);

/** EXEC COMMAND */
$_command        = 'sudo python '.PYTHON_PATH.'gmacro.py engage_feeder '.$_destination_trace.' '.$_destination_response.' > /dev/null';
$_output_command = shell_exec ( $_command );
$_pid            = trim(str_replace('\n', '', $_output_command));

/** WAIT JUST 1 SECOND */
sleep(1);

$_response = file_get_contents($_destination_response);
$_trace    = file_get_contents($_destination_trace);
$_trace    = str_replace(PHP_EOL, '<br>', $_trace);

/** RESPONSE */
$_response_items['url_check_response'] = host_name().'temp/response_'.$_time.'.log';
$_response_items['response']           = str_replace(PHP_EOL, '', $_response) == 'true' ? true : false;
$_response_items['trace']              = $_trace;
$_response_items['status']             = $_response_items['response']  == true ? 200 : 500;

/** WAIT JUST 1 SECOND */
sleep(1);
header('Content-Type: application/json');
echo minify(json_encode($_response_items));

?>