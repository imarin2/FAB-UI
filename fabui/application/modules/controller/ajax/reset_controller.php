<?php
require_once '/var/www/lib/config.php';


/** FORCE RESET CONTROLLER */
$_command = 'sudo python '.PYTHON_PATH.'force_reset.py';
shell_exec($_command);

//$_command = 'sudo python '.PYTHON_PATH.'flush.py';
//shell_exec($_command);
sleep(1);
include '/var/www/fabui/script/boot.php';

$_response_items['status'] = true;
sleep(3);
header('Content-Type: application/json');
echo json_encode($_response_items);


?>