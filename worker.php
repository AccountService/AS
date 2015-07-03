<?php
$worker = new GearmanWorker();
$worker->addServer('127.0.0.1');
$worker->addFunction('function_revert_string_and_caps', 'revCaps');
//$worker->work();
$i=0;
while ($worker->work()) {
	echo "Got job ".$i."\n";
	$i++;
}
function revCaps($job) {
	$content = $job->workload();
	return mb_strtoupper(strrev($content));
}
