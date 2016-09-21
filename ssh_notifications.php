#!/usr/bin/php
<?php

$data['time'] = date('G:i:s a');
$data['date'] = strtolower(date('Y-m-d (l)'));
$data['action'] = strtolower(trim(shell_exec('echo $PAM_TYPE')));
if($data['action'] == 'close_session') exit; //no need to warn about log-outs
$data['local host'] = php_uname('n');
$data['local user'] = trim(shell_exec('echo $PAM_USER'));
$data['remote host'] = trim(shell_exec('echo $PAM_RHOST'));
$data['remote user'] = trim(shell_exec('echo $PAM_RUSER'));

$to = 'youremail@example.com';
$subject = $data['local host']." accessed via ssh";
$body = "<html><body>
<table border=1 style='border-collapse:collapse;'>\n";
$td = "td style='padding: 4px;'";
foreach($data as $descr => $value) $body .= "<tr><$td>$descr</td><$td>$value</td></tr>\n";
$body .= "</table>
</body></html>";

$headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n";
//die("subject: [$subject], body: [$body]"); //debug
mail($to, $subject, $body, $headers);

?>
