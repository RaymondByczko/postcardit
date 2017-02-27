<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$mailerconfig['SMTPDebug'] = 2;

/*
The mail server.
*/
$mailerconfig['Host'] = "";

/*
Set the SMTP port number - likely to be 25, 465 or 587
*/
$mailerconfig['Port'] = 0;

/*
*/
$mailerconfig['']	= 'REQUEST_URI';

/*
Whether to use SMTP authentication
*/
$mailerconfig['SMTPAuth'] = true;

/*
Username to use for SMTP authentication
*/
$mailerconfig['Username'] = "";

/*
Password to use for SMTP authentication
*/
$mailerconfig['Password'] = "";
?>
