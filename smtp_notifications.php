#!/usr/bin/php
<?php

$data['time'] = date('G:i:s a');
$data['date'] = strtolower(date('Y-m-d (l)'));
$data['local host'] = php_uname('n');
$data['action'] = "attempt to connect to smtp server";

$remote_hosts = array("server 1" => "example.com", "server 2" => "example.com");
$timeout = 10; //seconds
foreach($remote_hosts as $host_name => $host_url)
{
	if($host_name == $data['local host']) continue; //do not test the email server on our own machine
	$data['remote host'] = $host_name; //overwrite
	@fsockopen($host_url, 25, $data['error number'], $data['error description'], $timeout);
	if(!$data['error number']) continue;
	$to = 'youremail@example.com';
	$subject = $data['remote host']."'s mail server is unreachable";
	$body = "<html><body>
<table border=1 style='border-collapse:collapse;'>\n";
	$td = "td style='padding: 4px;'";
	foreach($data as $descr => $value) $body .= "<tr><$td>$descr</td><$td>$value</td></tr>\n";
	$body .= "</table>
</body></html>";
	$headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n";
	//die("subject: [$subject], body: [$body]"); //debug
	mail($to, $subject, $body, $headers);
}

?>
