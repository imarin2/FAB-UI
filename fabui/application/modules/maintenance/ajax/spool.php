<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/fabui/ajax/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/fabui/ajax/lib/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/fabui/ajax/lib/utilities.php';



$_action = $_POST['action'];


/** CREATE LOG E MONITOR FILES */

$_time                 = time();
$_destination_trace    = TEMP_PATH.'spool_'.$_action.'_'.$_time.'.trace';
$_destination_response = TEMP_PATH.'spool_'.$_action.'_'.$_time.'.response';


write_file($_destination_trace, '', 'w');
chmod($_destination_trace, 0777);

write_file($_destination_response, '', 'w');
chmod($_destination_response, 0777);


/** EXEC COMMAND */
$_command        = 'sudo python /var/www/fabui/python/gmacro.py '.$_action.'_spool '.$_destination_trace.' '.$_destination_response.' > /dev/null & echo $!';
$_output_command = shell_exec ( $_command );
$_pid            = trim(str_replace('\n', '', $_output_command));






$_response_items = array();


$_response_items['command']      = $_command;
$_response_items['pid']          = $_pid;
$_response_items['uri_trace']    = '/temp/spool_'.$_action.'_'.$_time.'.trace';
$_response_items['uri_response'] = '/temp/spool_'.$_action.'_'.$_time.'.response';

/** WAIT JUST 1 SECOND */
sleep(1);
header('Content-Type: application/json');
echo minify(json_encode($_response_items));
?>